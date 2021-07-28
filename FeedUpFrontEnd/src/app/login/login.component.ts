import { UserService } from './../services/user.service';


import { User } from '../model/User.model';
import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
})
export class LoginComponent implements OnInit {
  user!: User;
  list!: User[];
  constructor(private authService: AuthService, public router: Router, private userService: UserService) { }



  ngOnInit(): void {
    this.user = new User();
    this.list = [];

    this.userService.getAllUsers().subscribe((data: User[]) => console.log(data));

  }


  onLoggedin() {
    this.authService.getUserFromDB(this.user.uid).subscribe((usr: User) => {
      if (usr.upassword == this.user.upassword) {
        this.authService.SignIn(usr);
        this.router.navigate(['/adduser']);
      }
      else
        console.log("error");
    })
   
  }


}