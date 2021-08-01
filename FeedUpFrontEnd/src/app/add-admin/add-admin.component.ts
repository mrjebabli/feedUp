import { UserService } from './../services/user.service';
import { AuthService } from './../services/auth.service';
import { User } from './../model/User.model';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-add-admin',
  templateUrl: './add-admin.component.html',
  styleUrls: ['./add-admin.component.css']
})
export class AddAdminComponent implements OnInit {
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
