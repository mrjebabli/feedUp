import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { User } from '../model/User.model';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  urlgetall = 'http://127.0.0.1:8000/user/getAllUsers';
  urladd='http://127.0.0.1:8000/user/adduser'
  url=' http://127.0.0.1:8000/user'
  
  constructor(private http: HttpClient) {}

  getAllUsers() {
    return this.http.get<User[]>(this.urlgetall);
  }
  addUser(u: User) {
    return this.http.post(this.urladd, u);
  }
  deleteUser(id: number) {
    return this.http.delete(this.url + "/" + id+ '/delete');
  }
  updateUser(id: number, u: User) {
    return this.http.put(this.url + '/updateuser/' + id, u);
  }
  getUser(id: number) {
    return this.http.get(this.url + '/' + id);
  }

}
