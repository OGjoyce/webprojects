
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Map, latLng, tileLayer, Layer, marker } from 'leaflet';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { AngularDelegate } from '@ionic/angular';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { ModalController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { LoadingController } from '@ionic/angular';
import { Storage } from '@ionic/storage';
declare let L;
@Component({
  selector: 'app-buscar',
  templateUrl: './buscar.page.html',
  styleUrls: ['./buscar.page.scss'],
})
export class BuscarPage implements OnInit {
  constructor(public router: Router, private geolocation: Geolocation, public httpClient: HttpClient,
              public modalController: ModalController, public alertController: AlertController,
              public loadingController: LoadingController,
              private storage: Storage) { }
  user: any;
  locations: any;
  key = '';
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
    /*
    Get 15 near services
     */
    this.controlvar = 0;
    this.user = history.state;
    await this.storage.get('secretKey').then((val) => {
      this.key = val;
        });
        if(history.state.comesfrom != true){
 

        }
        else{

        }

    
  }
  ionViewDidEnter() {
    this.leafletMap();
  }

  leafletMap() {
    this.geolocation.getCurrentPosition().then((resp) => {
      // resp.coords.latitude
      // resp.coords.longitude
      this.cordlat = resp.coords.latitude;
      this.cordlong = resp.coords.longitude;
      this.latlng = L.latLng(this.cordlat,  this.cordlong);

      /*agregar mapa*/
      this.map = new Map('mapId2').setView([this.latlng.lat, this.latlng.lng], 10);
      //tile.openstreetmap.org/
      tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'edupala.com'
      }).addTo(this.map);
      /*agregar icono*/
      const greenIcon = L.icon({
        iconUrl: 'http://simpleicon.com/wp-content/uploads/map-marker-13.png',
        iconSize:     [20, 20], // size of the icon
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
      });
     //L.marker([this.latlng.lat, this.latlng.lng], {icon: greenIcon}).addTo(this.map);
      console.log('lat: '+ this.latlng.lat + 'long: ' +this.cordlong);
      const markPoint = L.marker([this.latlng.lat, this.latlng.lng]);
      markPoint.bindPopup('<p>Aqui estas tu</p>');
    //  this.map.addLayer(markPoint);
      L.marker([this.latlng.lat, this.latlng.lng], {icon: greenIcon}).addTo(this.map)
      .bindPopup('Te encuentras aqui')
      .openPopup();
     }).catch((error) => {
       alert(error.message);
     });
     if(this.controlvar == 0 ){
      this.displayAllMarkers();
     }
    

  }
  displayAllMarkers(){
    
    const token = '15services';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/servicios.php?&token=${token}`)
    .subscribe(async data => {
      if (  Object.keys(data).length == null) {
        console.log('Bad!');
      } else {
        /*Place markers*/
        console.log(data);
       
        let i : number;
      // tslint:disable-next-line: prefer-for-of
        let ez = 0;
        // tslint:disable-next-line: align
      const hey =  Object.keys(data).length;
        const greenIcon = L.icon({
        iconUrl: 'https://stfrancisparish.org.uk/images/social/mapmarkers/free-map-marker-icon-pink.png',
        iconSize:     [20, 20], // size of the icon
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
      });
        const arr = new Array();
        while (ez < hey) {
          console.log(data[ez].latitud);
          let latandlong: any;
          latandlong = L.latLng(data[ez].latitud,  data[ez].longitud);
          const markPoint = L.marker([latandlong.lat, latandlong.lng]);
         // this.map.addLayer(markPoint);
          arr.push(marker([data[ez].latitud,  data[ez].longitud], {icon: greenIcon})
          // tslint:disable-next-line: max-line-length
          .bindPopup(`<div id="selectedMarker"><input type="hidden" id="inputdude" value="${data[ez].idServicios}"><input type="hidden" id="idProducto" value="${data[ez].id}">
          <input type="hidden" id="inputdudetitulo" value="${data[ez].titulodescripcion}"><p>${data[ez].titulodescripcion}</p></div>`).
          openPopup()
          .on('click', (e) => {
            console.log(e);
            const idServicio = document.getElementById('inputdude') as HTMLInputElement;
            const titulodesc = document.getElementById('inputdudetitulo') as HTMLInputElement;
            const idProducto = document.getElementById('idProducto') as HTMLInputElement;
            console.log(idProducto.value);
            this.contactar(idServicio.value, titulodesc.value, idProducto.value);
            
        }));
          ez++;
        }
        this.allMarkes = arr;
        this.groupLayer =  L.layerGroup(this.allMarkes);
        this.groupLayer.addTo(this.map);
      }
     }, error => {
      console.log(error);
    });

  }
  displayMarkersByFilter(filter){

    const token = 'getMarkersByFilter';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/servicios.php?&token=${token}&filtro=${filter}`)
    .subscribe(async data => {
      if (  Object.keys(data).length == null) {
        console.log('Bad!');
      } else {
        /*Place markers*/
        console.log(data);
       
        let i : number;
      // tslint:disable-next-line: prefer-for-of
        let ez = 0;
        // tslint:disable-next-line: align
      const hey =  Object.keys(data).length;
        const greenIcon = L.icon({
        iconUrl: 'https://stfrancisparish.org.uk/images/social/mapmarkers/free-map-marker-icon-pink.png',
        iconSize:     [20, 20], // size of the icon
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
      });
        const arr = new Array();
        while (ez < hey) {
          let latandlong: any;
          latandlong = L.latLng(data[ez].latitud,  data[ez].longitud);
          const markPoint = L.marker([latandlong.lat, latandlong.lng]);
         // this.map.addLayer(markPoint);
          arr.push(marker([data[ez].latitud,  data[ez].longitud], {icon: greenIcon})
          // tslint:disable-next-line: max-line-length
          .bindPopup(`<div id="selectedMarker"><input type="hidden" id="inputdude" value="${data[ez].idServicios}"><input type="hidden" id="idProducto" value="${data[ez].id}">
          <input type="hidden" id="inputdudetitulo" value="${data[ez].titulodescripcion}"><p>${data[ez].titulodescripcion}</p></div>`).
          openPopup()
          .on('click', (e) => {
            console.log(e);
            const idServicio = document.getElementById('inputdude') as HTMLInputElement;
            const titulodesc = document.getElementById('inputdudetitulo') as HTMLInputElement;
            const idProducto = document.getElementById('idProducto') as HTMLInputElement;
            console.log(idProducto.value);
            this.contactar(idServicio.value, titulodesc.value, idProducto.value);
        }));
          ez++;
        }
        this.allMarkes = arr;
        this.groupLayer =  L.layerGroup(this.allMarkes);
        this.groupLayer.addTo(this.map);
      }
     }, error => {
      console.log(error);
    });

  }
  ionViewWillLeave() {
    this.map.remove();
  }
  async searchIt(){
    this.controlvar = 1;
    console.log(this.search);
    this.groupLayer.removeLayer(this.allMarkes);
    //Loading...
    //removermapa...
    //hacer mapa y buscar los markers necesarios
    //agregar mapa, tu estas aqui y markers con filtros.
    //quitar loading
    const loading = await this.loadingController.create({
      message: 'Realizando Busqueda',
      });
    await loading.present();
    this.ionViewWillLeave();
    this.leafletMap();
    this.displayMarkersByFilter(this.search);
    loading.dismiss();

  }
  back(){
    this.user = history.state;
    this.router.navigate(['/menu/:user'], {state: this.user});
  }


  async contactar(thiu, titulo, idProducto){
    /*generar contacto*/
   
    // user.id quiere contactar a thiuservicio
    const idservicio = thiu;
    const alert1 = await this.alertController.create({
      header: 'Contratar Servicio',
      message: titulo,
      buttons: [
        {
          text: 'Contactar',
          role: 'cancel',
          cssClass: 'primary',
          handler: (blah) => {

            const token = 'contactbymap';
            // tslint:disable-next-line: max-line-length
            this.httpClient.get(`https://lanzalibre.000webhostapp.com/contact.php?&token=${token}&contratador=${history.state.id}&idservicio=${thiu}&idproducto=${idProducto}`)
            .subscribe(async data => {
              if ( data == null) {
                alert("error");
              } else {
                this.router.navigate(['/elegance/:user'], {state: this.user});
              }
             }, error => {
              console.log(error);
            });
           
          }
        }, {
          text: 'Ver perfil',
          handler: () => {
            const token = 'profile';
            // tslint:disable-next-line: max-line-length
            this.httpClient.get(`https://lanzalibre.000webhostapp.com/contact.php?&token=${token}&contratador=${history.state.id}&idservicio=${thiu}`)
            .subscribe(async externaldata => {
              if ( externaldata == null) {
              } else {
                this.router.navigate(['/profile/:user'], {state: externaldata});
              }
             }, error => {
              console.log(error);
            });
          }
        }
      ]
    });
    await alert1.present();

   
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
