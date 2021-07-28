import { User } from './../model/User.model';
import { UserService } from './../services/user.service';
import { AuthService } from './../services/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-add-user',
  templateUrl: './add-user.component.html',
  styleUrls: ['./add-user.component.css']
})
export class AddUserComponent implements OnInit {
  user: User;
  list: User[];

  constructor(private authService : AuthService,private userService: UserService) { }

  ngOnInit(): void {
    this.user = new User();
    this.list = [];
  }
  addD() {
    console.log(this.user)
    this.userService
    .addUser(this.user)
    .subscribe(() => (this.list = [this.user, ...this.list]));
    window.location.pathname = '/users';
  }

}
