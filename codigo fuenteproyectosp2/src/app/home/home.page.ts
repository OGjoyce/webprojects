import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { Storage } from '@ionic/storage';
import { Geolocation } from '@ionic-native/geolocation/ngx';
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {
  user = '';
  password = '';
  key ='';
  nombres = '';
  apellidos = '';
  email = '';
  dpi = '';
  cel = '';
  municipios: any[] = [
  ];
  selectedCountry: any;
  cordlat: string;
  cordlong: string;
  latlng: any;
  constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router, private storage: Storage,
              public geolocation: Geolocation) {


                const token = 'getMunicipios';
                this.httpClient.get(`https://lanzalibre.000webhostapp.com/register.php?&token=${token}`)
                .subscribe(async data => {
                  if ( data == null) {
                    console.log('Bad!');
                    const alert = await this.alertController.create({
                      header: 'Error',
                      message: 'Please try again.',
                      buttons: [
                        {
                          text: 'Try again',
                          cssClass: 'primary'
                        }
                      ]
                    });
                    await alert.present();
                  } else {
                    let largo: any;
                    largo = data;
                    for (let index = 0; index < largo.length; index++) {
                      const lol = {
                        id: index,
                        first: data[index]};
                      this.municipios.push(lol);
                    }
                  }
                 }, error => {
                  console.log(error);
                });



              }
  async ngOnInit() {
      await this.storage.get('secretKey').then((val) => {
    this.key = val;
      });
      const token = 'login';
      this.httpClient.get(`https://lanzalibre.000webhostapp.com/login.php?&token=${token}&key=${this.key}`)
    .subscribe(async data => {
      if ( data == null) {
      } else {

        this.router.navigate(['/menu/:user'], {state: data});
      }
     }, error => {
    });

    
      this.geolocation.getCurrentPosition().then((resp) => {
      // resp.coords.latitude
      // resp.coords.longitude
      this.cordlat = resp.coords.latitude.toString();
      console.log(this.cordlat);
      this.cordlong = resp.coords.longitude.toString();
      this.cordlat = this.hexEncode(this.cordlat);
      this.cordlong = this.hexEncode(this.cordlong);
      console.log('lat: ' + this.cordlat + 'long: ' + this.cordlong);
     }).catch((error) => {
       alert(error.message);
     });


  }
  hexEncode(str: string){
    let arr1 = [];
    for (let n = 0, l = str.length; n < l; n ++)
       {
      const hex = Number(str.charCodeAt(n)).toString(16);
      arr1.push(hex);
     }
    return arr1.join('');

  }
  sendPostRequest() {

    const httpHeaders = new HttpHeaders()
     .set('Content-Type', 'application/json')
     .set('Accept', 'application/json');

    const options = {
      headers: httpHeaders
    };

    const token = 'login';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/login.php?&token=${token}&user=${this.user}&pws=${this.password}`)
    .subscribe(async data => {
      if ( data == null) {
        console.log('Bad bad bad so bad');
        const alert = await this.alertController.create({
          header: 'Invalid credentials',
          message: 'Please try again.',
          buttons: [
            {
              text: 'Try again',
              cssClass: 'primary'
            }
          ]
        });
        await alert.present();
      } else {
         // set a key/value
         console.log('Bad bad bad so bad but ELSE');
         let object: any;
         object = data;
         this.storage.set('secretKey', object.key);
         console.log(data);
         this.router.navigate(['/menu/:user'], {state: data});
      }
     }, error => {
      console.log(error);
    });
  }
   createAccount() {
   this.router.navigate(['/register']);
   console.log('creating account...');
  }
  showLogin(){
    document.getElementById('login').style.display = 'block';
    document.getElementById('register').style.display = 'none';
  }
  showRegister(){
    document.getElementById('login').style.display = 'none';
    document.getElementById('register').style.display = 'block';

  }
  registerRequest() {

    const token = 'register';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/register.php?&token=
    ${token}&nombres=${this.nombres}&apellidos=${this.apellidos}&pws=${this.password}
    &dpi=${this.dpi}&cel=${this.cel}&municipio=1&token=${token}&email=${this.email}
    &lat=${this.hexEncode(this.cordlat)}&lng=${this.hexEncode(this.cordlong)}`)
    .subscribe(async data => {
      if ( data == null) {
        console.log('Bad!');
        const alert = await this.alertController.create({
          header: 'Error',
          message: 'Please try again.',
          buttons: [
            {
              text: 'Try again',
              cssClass: 'primary'
            }
          ]
        });
        await alert.present();
      } else {
        const alert = await this.alertController.create({
          header: 'Your username',
          message: ' ' + data,
          buttons: [
            {
              text: 'Login',
              role: 'cancel',
              cssClass: 'primary',
              handler: (blah) => {
                location.href = '/home';
              }
            }, {
              text: 'Okay',
              handler: () => {
                console.log('Confirm Okay');
              }
            }
          ]
        });
        await alert.present();
      }
     }, error => {
      console.log(error);
    });
  }

}
