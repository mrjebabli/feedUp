import { Role } from './../model/Role.model';
import { User } from './../model/User.model';
import { Observable } from 'rxjs';

import { Router } from '@angular/router';
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {


  apiURL: string = 'http://127.0.0.1:8000/user';

  public loggedUser: string;
  public isloggedIn: Boolean = false;
  public roles: Role[];

  constructor(private router: Router, private http: HttpClient) { }


  getUserFromDB(uid: string): Observable<User> { 
    const url = `${this.apiURL}/${uid}`;
    
  return this.http.get<User>(url); 
 
}

  SignIn(user:User){ 
    this.loggedUser = user.uid; 
    this.isloggedIn = true; 
    this.roles = user.utype;
    
     localStorage.setItem('loggedUser',this.loggedUser);
     localStorage.setItem('isloggedIn',String(this.isloggedIn));
     this.router.navigate(['/users']);
    }

logout() {
  this.isloggedIn = false;
  this.loggedUser = "undefi   ned";
  localStorage.removeItem('loggedUser');
  localStorage.setItem('isloggedIn', String(this.isloggedIn));
  this.router.navigate(['/login']);
}

isAdmin():Boolean{

  
let admin: Boolean = false;

  if (!this.roles) //this.roles == undefiened     
    return false;
  if (this.loggedUser.toUpperCase() == 'ADMIN') {
      admin = true;
    }
  return admin;
}


setLoggedUserFromLocalStorage(login: string) {
  this.loggedUser = login;
  this.isloggedIn = true;
  this.getUserType(login);
}

getUserType(uid: string) {

  this.getUserFromDB(uid).subscribe((user: User) => {
    this.roles = user.utype;

  });

}


}
