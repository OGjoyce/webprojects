import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { stringify } from 'querystring';
@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage implements OnInit {
  nombres = '';
  apellidos = '';
  email = '';
  password = '';
  dpi = '';
  cel = '';
  municipios: any[] = [
  ];
  selectedCountry: any;
  user: any;
  cordlat: string;
  cordlong: string;
  latlng: any;
  constructor(
              public httpClient: HttpClient,
              public alertController: AlertController,
              public router: Router,
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


  ngOnInit() {
    
    /*get location*/

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
  var arr1 = [];
	 for (var n = 0, l = str.length; n < l; n ++) 
     {
		var hex = Number(str.charCodeAt(n)).toString(16);
		arr1.push(hex);
	 }
	 return arr1.join('');

}

registerRequest() {

   

    let object1: any;
    object1 = document.getElementById('selected').childNodes[3];
    this.selectedCountry = object1.value;
    var n = this.selectedCountry.includes("-");
    this.selectedCountry = this.selectedCountry.substring(0, n);
    const token = 'register';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/register.php?&token=
    ${token}&nombres=${this.nombres}&apellidos=${this.apellidos}&pws=${this.password}&dpi=${this.dpi}&cel=${this.cel}&municipio=${this.selectedCountry}&token=${token}&email=${this.email}&lat=${this.hexEncode(this.cordlat)}&lng=${this.hexEncode(this.cordlong)}`)
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
  back(){
    this.user = history.state;
    this.router.navigate(['/home']);
  }
}
