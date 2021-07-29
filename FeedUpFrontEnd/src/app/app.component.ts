import { Router } from '@angular/router';
import { AuthService } from './services/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title = 'FrontEnd';
 
  constructor(public authService: AuthService,
    private router: Router){}

    ngOnInit () {
      let isloggedin: string;
      let loggedUser:string;
      isloggedin =  String(localStorage.getItem('isloggedIn'));
      loggedUser =  String (localStorage.getItem('loggedUser'));
      loggin :Boolean;
      

      if (isloggedin!="true" || !loggedUser)
          this.router.navigate(['/login']);
          
      else
       this.authService.setLoggedUserFromLocalStorage(loggedUser);
       this.router.navigate(['/login']);

    }
  
    
    onLogout(){
      this.authService.logout();
      window.location.pathname = '/login';
    }

}
