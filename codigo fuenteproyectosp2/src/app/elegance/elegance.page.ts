
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { AlertController } from '@ionic/angular';
import { Storage } from '@ionic/storage';
@Component({
  selector: 'app-elegance',
  templateUrl: './elegance.page.html',
  styleUrls: ['./elegance.page.scss'],
})
export class ElegancePage implements OnInit {
public chatData:any;
key = '';
  constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router, private storage: Storage) { }
  user: any;
  imagevar = '../../assets/users/user.png';
  async ngOnInit() {
    await this.storage.get('secretKey').then((val) => {
      this.key = val;
        });
        
    this.user = history.state;
    console.log(history.state);
    const token = 'getChatList';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/contact.php?&token=${token}&contratador=${this.user.id}`)
    .subscribe(async data => {
      if ( data == null) {
        const alert = await this.alertController.create({
          header: '¡Atención!',
          message: 'Para chatear con un hydra haz un contacto por medio del mapa',
          buttons: [
            {
              text: 'Llevarme a mapa',
              cssClass: 'primary',
              handler: (blah) => {
                this.buscarServicio();
              }
            }, {
              text: 'Regresar',
              handler: () => {
                this.handleHome();
              }
            }
          ]
        });
        await alert.present();
      } else {
       this.chatData = data;
      }
     }, error => {
      console.log(error);
    });
  
  }
  back() {
    this.user = history.state;
    this.router.navigate(['/menu/:user'], {state: this.user});
  }
  chatTo(id, name, producto){
    const externalUser = id;
    const internalUser = this.user.id;
    const externalProduct = producto;
    history.state.external = id;
    this.user = history.state;
    this.user.externalname = name;
    this.user.externalProduct = producto;
    console.log(this.user.externalProduct + "41 elegance");
    this.router.navigate(['/chat/:user'], {state: this.user});
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
