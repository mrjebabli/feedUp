import { DeleteUserComponent } from './delete-user/delete-user.component';
import { EditUserComponent } from './edit-user/edit-user.component';
import { AddUserComponent } from './add-user/add-user.component';
import { UsersComponent } from './users/users.component';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { ForbiddenComponent } from './forbidden/forbidden.component';
import { ProduitGuard } from './user.guard';

const routes: Routes = [
  { path: 'login', component:LoginComponent },
  {path:  'forbidden', component: ForbiddenComponent},
  {path:  'adduser', component:AddUserComponent},
  {path:  'deleteuser', component: DeleteUserComponent},
 
  {path:  'edituser', component:EditUserComponent},
 
  { path: 'users', component:UsersComponent , canActivate:[ProduitGuard]}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
