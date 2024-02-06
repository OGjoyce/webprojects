import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-insertarservicio',
  templateUrl: './insertarservicio.page.html',
  styleUrls: ['./insertarservicio.page.scss'],
})
export class InsertarservicioPage implements OnInit {

  constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router) { }
  titulo: any;
  descripcion: any;
  costo: any;
  servicio: any;
  descripcionServicio: any;
  product: any;
  productNumber: number;

  usr = history.state;
  todo = {
    title: '',
    description: ''
  };
  logForm(form) {
    console.log(form.value)
  }

  ngOnInit() {
    this.titulo='Inserte Titulo del servicio';
    this.descripcion = 'Inserte descricipción de titulo';
    this.servicio='insertar servicio';
    this.descripcionServicio = 'Lorem ipsum dolor sit amet ';
    this.product = [
       {
         "id" : "0",
        "product" : "Producto 1",
        "productDescription": "Descripcion de producto 1"
      }
    ];
  }
  insertarServicio() {
    const token = 'insertarservicio';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/servicios.php?&token=${token}&userid=${this.usr.id}&servicio=${this.servicio}
    &descripcion=${this.descripcion}&costo=${this.costo}`)
    .subscribe(async data => {
      if ( data == '1') {
        const alert = await this.alertController.create({
          header: 'Felicidades',
          message: 'Su servicio es visible en toda Guatemala!',
          buttons: [
            {
              text: 'Gracias',
              cssClass: 'primary'
            }
          ]
        });
        await alert.present();
        this.router.navigate(['/menu/:user'], {state: history.state});
      } else {
        console.log(data + 'else');
      }
     }, error => {
      console.log(error);
    });
  }
  addRow(thiou){
    let n: number = this.product.length;
    console.log(thiou);
    let newIndex = this.product.length;

    this.product[newIndex] =  {
         "id" : "1",
        "product" : "Producto 1",
        "productDescription": "Descripcion de producto 1"
      };

  }
  deleteRow(){
    let n: number = this.product.length;
    this.product.splice(n-1);
  }
  async saveData(){
    const titulo = this.titulo;
    const d = this.descripcion;
    const serv = this.servicio;
    const serdisc = this.descripcionServicio;
    let postData = [
            {"titulo": titulo},
            {"descripcionTitulo": d},
            {"servicio": serv},
            {"servicioDesc": serdisc},
            {"idUser": history.state.id},
            {"products": JSON.stringify(this.product)}
    ];
    let headers = new HttpHeaders({
    'Content-Type': 'application/json'
 });
 let options = {
    headers: headers
 };

    const params = new FormData();
    params.append('titulo',titulo);
    params.append('descripcionTitulo',d);
    params.append('servicio',serv);
    params.append('servicioDesc', serdisc);
    params.append('idUser', history.state.id);
    params.append('products', JSON.stringify(this.product));
    this.httpClient.post("https://lanzalibre.000webhostapp.com/servicios.php?&token=addProducts", params, {responseType: 'text'})
      .subscribe( async data => {
        console.log(data);
        if(data==='1'){
          const alert = await this.alertController.create({
          header: 'Felicidades',
          message: 'Su servicio es visible en toda Guatemala!',
          buttons: [
            {
              text: 'Gracias',
              cssClass: 'primary'
            }
          ]
        });
        await alert.present();
        this.router.navigate(['/menu/:user'], {state: history.state});
        }
        else{
          {
          const alert = await this.alertController.create({
          header: 'Cancelado',
          message: 'Intente de nuevo',
          buttons: [
            {
              text: 'Gracias',
              cssClass: 'primary'
            }
          ]
        });
        await alert.present();
        this.router.navigate(['/menu/:user'], {state: history.state});
        }

        }
       }, error => {
        console.log("ERRRRRR" +  error.message);
      });
  }
  
  

}
