import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { User } from '../model/User.model';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  urlgetall = 'http://127.0.0.1:8000/user/getAllUsers';
  urladd='http://127.0.0.1:8000/user/adduser'
  url=' http://127.0.0.1:8000/user/updateuser'
  urlId=' http://127.0.0.1:8000/user/get'
  urlDe='http://127.0.0.1:8000/user'
  
  constructor(private http: HttpClient) {}

  getAllUsers() {
    return this.http.get<User[]>(this.urlgetall);
  }
  addUser(u: User) {
    return this.http.post(this.urladd, u);
  }
  deleteUser(id: number) {
    return this.http.delete(this.urlDe + "/" + id + '/delete');
  }
  updateUser(uid: number, u: User) {
    console.log(this.url + '/' + uid)
    return this.http.put(this.url + '/' + uid, u);
    

  }

 

  getUser(uid: string) {
    return this.http.get(this.url + '/' + uid);
  }

  getUserById(id: number) {
    return this.http.get(this.urlId + '/' + id);
  }

}
