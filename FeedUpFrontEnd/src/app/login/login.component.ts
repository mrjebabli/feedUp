

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
  constructor(private authService : AuthService,public router: Router) { }

  ngOnInit(): void {
    this.user = new User();
    this.list = [];
   

  }
  onLoggedin()
  {
    
    console.log(this.user);
    let isValidUser: Boolean = this.authService.SignIn(this.user);
    console.log("valid user "+isValidUser);
    if (isValidUser)
    {
      console.log("isadmin "+this.authService.isAdmin());
      this.router.navigate(['/']);     
    }
      
}

}
