import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AlertController } from '@ionic/angular';
@Component({
  selector: 'app-home-home',
  templateUrl: './home-home.page.html',
  styleUrls: ['./home-home.page.scss'],
})
export class HomeHomePage implements OnInit {
  user = history.state;
  constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router) { }
  json : any;
  clicked: any;
  ngOnInit() {
    const token = 'top10';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/servicios.php?&token=${token}`)
    .subscribe(async data => {
      if ( data == null) {
      } else {
       console.log(data);
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
  greed(obj: any) {
    console.log(obj);

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
}
