import { Role } from './Role.model';

export class User {
	id:number;
	uid: string;
	uprenom: string ;
	unom: string ;
	uphone: number ;
	uemail: string ;
	upassword: string ;
    utype: Role[];	
		
}

	