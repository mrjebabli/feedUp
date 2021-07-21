import { Router } from '@angular/router';
import { AuthService } from './services/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent  {
  title = 'FrontEnd';

  constructor(public authService: AuthService,
    private router: Router){}

  
    
    onLogout(){
      this.authService.logout();
      window.location.pathname = '/login';
    }

}
