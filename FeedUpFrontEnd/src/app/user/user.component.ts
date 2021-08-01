import { Router } from '@angular/router';
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
 

  constructor(private authServ : AuthService,private usSEr: UserService,public router:Router) { }

  ngOnInit(): void {
  }

 
  deleteuser(id : any){

    this.usSEr.deleteUser(id).subscribe(() => {

      this.userList = this.userList.filter(e => e.id !== id );
      this.router.navigate(['/user']);

      window.location.reload();

    })

}
}