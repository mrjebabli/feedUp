import { UserService } from './../services/user.service';
import { AuthService } from './../services/auth.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { User } from '../model/User.model';

@Component({
  selector: 'app-edit-user',
  templateUrl: './edit-user.component.html',
  styleUrls: ['./edit-user.component.css']
})
export class EditUserComponent implements OnInit {
  user: User;
  userList: User[];
  id: number;
  requestedUser: User;


  constructor(private authService : AuthService,private userService: UserService,private route: ActivatedRoute) { }

  ngOnInit(): void {
    
  }

  updateUser() {
    console.log(this.user);
    this.userService
      .updateUser(this.route.snapshot.params.id, this.user)
      .subscribe();
    window.location.pathname = '/users';
  }

}
