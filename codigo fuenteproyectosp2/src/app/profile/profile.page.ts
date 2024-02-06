import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {

  constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router) { }
  servicios : any;
  rating: any;
  name: any;
  username: any;
  titulos: any;
  user:any;
  ngOnInit() {
    this.user = history.state;
    this.getNames(history.state);
    this.getServices(history.state);
    this.getTitulos(history.state);
    this.getRanks(history.state);
  }

  getRanks(information){
    const token = "getRank";
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/profile.php?&token=${token}&key=${information.key}`)
    .subscribe(async rates => {
      if ( rates == null) {
        this.rating = "0";
      } else {
        this.rating = rates;
       
      }
     }, error => {
      console.log(error);
    });

  }

  getNames(information){
    const token = "getProfileNames";
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/profile.php?&token=${token}&key=${information.key}`)
    .subscribe(async nombres => {
      if ( nombres == null) {
       this.router.navigate(['/home']);
      } else {
        this.name = nombres[0];
        this.username = nombres[1];
      }
     }, error => {
      console.log(error);
    });

  }

  getServices(information){

    const token = "getProfileServicios";
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/profile.php?&token=${token}&key=${information.key}`)
    .subscribe(async data => {
      if ( data == null) {
       // this.router.navigate(['/home']);
      } else {
        console.log(data);
        this.servicios = data;
       
      }
     }, error => {
      console.log(error);
    });


  }
  getTitulos(information){
    const token = "getAllServices";
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/profile.php?&token=${token}&usrid=${information.id}`)
    .subscribe(async data => {
      if ( data == null) {
       // this.router.navigate(['/home']);
      } else {
        console.log(data);
        this.titulos = data;
       
      }
     }, error => {
      console.log(error);
    });
  }
  viewOnMap(){
    history.state.comesfrom = true;
    this.user = history.state;
    this.router.navigate(['/buscar/:user'], {state: this.user});

  }
  async contactar(thiu){
    /*generar contacto*/
   
    // user.id quiere contactar a thiu

    const alert = await this.alertController.create({
      header: 'Contactar el siguiente usuario:',
      message: ' ' + thiu,
      buttons: [
        {
          text: 'Si',
          role: 'cancel',
          cssClass: 'primary',
          handler: (blah) => {
            const token = 'contact';
            this.httpClient.get(`https://lanzalibre.000webhostapp.com/contact.php?&token=${token}&contratador=${this.user.id}&contratado=${thiu}`)
            .subscribe(async data => {
              if ( data == null) {
              } else {
               console.log(data);
              }
             }, error => {
              console.log(error);
            });
          }
        }, {
          text: 'No',
          handler: () => {
            console.log('Not se contacto');
          }
        }
      ]
    });
    await alert.present();

   
  }
  back(){
    this.user = history.state;
    this.router.navigate(['/menu']);
  }
  profile(userKey){
    console.log(userKey);
    this.router.navigate(['/profile/:user'], {state: this.user});
  }
  handleHome() {
    this.router.navigate(['/menu/:user'], {state: this.user});
  }
  handleAutenticar() {
    this.router.navigate(['/autenticar/:user'], {state: this.user});

  }
  ofrecerServicio() {
    this.router.navigate(['/ofrecer/:user'], {state: this.user});
  }
  buscarServicio() {
    this.router.navigate(['/buscar/:user'], {state: this.user});
  }
  contactos(){
    this.router.navigate(['/elegance/:user'], {state: this.user});
  }

}
