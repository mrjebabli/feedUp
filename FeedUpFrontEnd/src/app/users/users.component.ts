import { User } from './../model/User.model';
import { UserService } from './../services/user.service';
import { AuthService } from './../services/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css']
})
export class UsersComponent implements OnInit {
  userList: User[];
  user: User;
  constructor(private authService : AuthService,private userService: UserService) { }

  ngOnInit(): void {
    this.userService.getAllUsers().subscribe((data: User[]) => (this.userList = data));
  }

}
