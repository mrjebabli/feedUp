import { AuthService } from './../services/auth.service';
import { UserService } from './../services/user.service';
import { Component, Input, OnInit } from '@angular/core';
import { User } from '../model/User.model';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {
  @Input() user: User;
  userList: User[];
 

  constructor(private authServ : AuthService,private usSEr: UserService) { }

  ngOnInit(): void {
  }

  SuppDrug(id:number) {
    this.usSEr.deleteUser(id).subscribe(() => {
      this.userList = this.userList.filter((i) => i.id != id);
    });
    console.log('this id is ' + id);
    window.location.pathname = '/users';
  }

}
