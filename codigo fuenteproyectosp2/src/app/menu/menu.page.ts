import { Component, OnInit } from '@angular/core';
import { MenuController } from '@ionic/angular';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import { HomePage } from '../home/home.page';
import { NavController } from '@ionic/angular';
import { Storage } from '@ionic/storage';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AlertController } from '@ionic/angular';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Map, latLng, tileLayer, Layer, marker } from 'leaflet';
declare let L;
@Component({
  selector: 'app-menu',
  templateUrl: './menu.page.html',
  styleUrls: ['./menu.page.scss'],
})
export class MenuPage implements OnInit {
  user: any;
  username = '';


  constructor(public httpClient: HttpClient, private menu: MenuController, private route: Router, private activatedRoute: ActivatedRoute,
              public navCtrl: NavController, private storage: Storage, public alertController: AlertController
              , private geolocation: Geolocation) { }

    key = '';
  stuff : any;
  locations: any;
  map: Map;
  cordlat :any;
  cordlong: any;
  latlng: any;
  search: any;
  allMarkes: any;
  groupLayer: any;
  servicio: any;
  controlvar = 0; 

  async ngOnInit() {
      await this.storage.get('secretKey').then((val) => {
    this.key = val;
      });
      const token = 'login';
      this.httpClient.get(`https://lanzalibre.000webhostapp.com/login.php?&token=${token}&key=${this.key}`)
    .subscribe(async data => {
      if ( data == null) {
        this.route.navigate(['/home'], {state: data});
      } else {
       console.log(data);
       this.route.navigate(['/menu/:user'], {state: data});
       this.user = data;
        //document.getElementById('labelName').innerHTML = this.user.usr;
      }
     }, error => {
      console.log(error);
    });


  }


  ionViewDidEnter() {
    //this.leafletMap();

  }


  profile(userKey){
    console.log(this.user);
    this.route.navigate(['/profile/:user'], {state: this.user});
  }
  handleHome() {
    this.route.navigate(['/menu/:user'], {state: this.user});
  }
  handleAutenticar() {
    this.route.navigate(['/autenticar/:user'], {state: this.user});

  }
  ofrecerServicio() {
    this.route.navigate(['/ofrecer/:user'], {state: this.user});
  }
  buscarServicio() {
    this.route.navigate(['/buscar/:user'], {state: this.user});
  }
  contactos(){
    this.route.navigate(['/elegance/:user'], {state: this.user});
  }
  logout(){
    this.storage.clear();
    this.route.navigate(['/home/']);
  }

}
