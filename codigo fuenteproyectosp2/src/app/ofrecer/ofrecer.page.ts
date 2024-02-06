import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Storage } from '@ionic/storage';
@Component({
  selector: 'app-ofrecer',
  templateUrl: './ofrecer.page.html',
  styleUrls: ['./ofrecer.page.scss'],
})
export class OfrecerPage implements OnInit {
  user = history.state.id;
  verified: any;
  
constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router,
            private storage: Storage) { }
key = '';
slideOpts = {
  initialSlide: 1,
  speed: 400
};
json: any;
/*iniciamos con verify */
  async ngOnInit() {

    this.user = history.state;
    await this.storage.get('secretKey').then((val) => {
      this.key = val;
        });
    const httpHeaders = new HttpHeaders()
     .set('Content-Type', 'application/json')
     .set('Accept', 'application/json');

    const options = {
      headers: httpHeaders
    };
  

    const token = 'myServices';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/servicios.php?&token=${token}&userid=${this.user.id}`)
    .subscribe(async data => {
      if ( data == null) {
       // this.router.navigate(['/home']);
      
       
      } else {
     
        this.json = data;
       
      }
     }, error => {
      console.log(error);
    });
  }
back() {
    this.user = history.state;
    this.router.navigate(['/menu/:user'], {state: this.user});
  }
  async alertar() {
    const alert = await this.alertController.create({
    header: 'Contratar',
    message: 'Ve a la sección de servicios',
    buttons: [
      {
        text: 'Ok',
        cssClass: 'primary'
      }
    ]
  });
    await alert.present();


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
  handleAgregar(){
    this.router.navigate(['/agregar/:user'], {state: history.state});
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
