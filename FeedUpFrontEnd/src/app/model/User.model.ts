import { Role } from './Role.model';

export class User {
	id:number;
	uid: string;
	uprenom: string ;
	unom: string ;
	uphone: string ;
	uemail: string ;
	upassword: string ;
    utype: Role[];	
		
}

	