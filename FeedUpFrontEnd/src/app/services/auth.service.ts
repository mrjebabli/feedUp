import { User } from '../model/User.model';
import { Router } from '@angular/router';
import { Injectable } from '@angular/core';


@Injectable({
  providedIn: 'root'
})
export class AuthService {
  users: User[] = [
    { "uid": "med", "upassword": "a123", "utype": ['USER'] },
    { "uid": "admin", "upassword": "a123", "utype": ['ADMIN'] }
  
  ];
  apiURL: string = 'http://localhost:8081/users/login';
  public loggedUser: string;
  public isloggedIn: Boolean = false;
  public utype: string[];

  constructor(private router: Router) { }
  SignIn(user: User): Boolean {
    let validUser: Boolean = false;
    this.users.forEach((curtUser) => {
      if (user.uid === curtUser.uid && user.upassword == curtUser.upassword) {
        validUser = true;
        this.loggedUser = curtUser.uid;
        this.isloggedIn = true;
        this.utype = curtUser.utype;


        localStorage.setItem('loggedUser', this.loggedUser);
        localStorage.setItem('isloggedIn', String(this.isloggedIn));
      }
    });

    return validUser;
  }
  logout() {
    this.isloggedIn = false;
    this.loggedUser = "undefined";
    localStorage.removeItem('loggedUser');
    localStorage.setItem('isloggedIn', String(this.isloggedIn));
    this.router.navigate(['/login']);
  }


  isAdmin(): Boolean {
    if (!this.utype) //this.roles== undefiened
      return false;
    console.log(this.utype.indexOf('ADMIN') ); 
    return (this.utype.indexOf('ADMIN') > -1);
  }

  setLoggedUserFromLocalStorage(login: string) {
    this.loggedUser = login;
    this.isloggedIn = true;
    this.getUserRoles(login);
  }

  getUserRoles(uid: string) {
    this.users.forEach((curUser) => {
      if (curUser.uid == uid) {
        this.utype = curUser.utype;
      }
    });
  }


}
