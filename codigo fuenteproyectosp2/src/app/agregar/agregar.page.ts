import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController, Platform } from '@ionic/angular';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer/ngx';
import { LoadingController } from '@ionic/angular';
import { WebView } from '@ionic-native/ionic-webview/ngx';
import { Statement } from '@angular/compiler';
import { Storage } from '@ionic/storage';
@Component({
selector: 'app-agregar',
templateUrl: './agregar.page.html',
styleUrls: ['./agregar.page.scss'],
})
export class AgregarPage implements OnInit {
user = history.state.id;
product: any;
titulo: any;
tipos: any[] = [
];
image: any='';
imageData:any=''
item: any;
imagePath: any;
// tslint:disable-next-line: max-line-length
constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router, private camera: Camera, private transfer: FileTransfer,
            public loadingController: LoadingController, public webview: WebView, private storage: Storage,
            platform: Platform) { }

key = '';
ngOnInit() {
    console.log(history.state);
    this.product = [
      {
        'id' : '0',
      'product' : '',
      'productDescription': ''
    }
  ];
    const lol = {
                      nombre: 'Carpintero'};
    this.tipos.push(lol);
    const lola = {
                      nombre: 'Jardinero'};
    this.tipos.push(lola);
    var serv = {
    nombre: 'Plomero'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Cocinero'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Ingeniero'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Albañil'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Niñera'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Empleado doméstico'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Panadero'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Minero'};
    this.tipos.push(serv);
    var serv = {
nombre: 'Pescador'};
    this.tipos.push(serv);
}
 async logForm(){
  
  var params = new FormData();
  if(this.image==''){
    alert("Ingrese una imagen valida.");
  }
  else{
  await this.upload();
  this.item = this.image;
  const type = document.getElementById('selected') as HTMLInputElement;

  params.append('titulo', this.titulo);
  params.append('tipo', type.value );
  params.append('idUser', history.state.id);
  params.append('products', JSON.stringify(this.product));
  params.append('imagen', this.imagePath.toString());

  this.httpClient.post("https://lanzalibre.000webhostapp.com/servicios.php?&token=addProducts", params, {responseType: 'text'})
    .subscribe( async data => {
      if(data === '1'){
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
        const alert2 = await this.alertController.create({
        header: 'Cancelado',
        message: 'Intente de nuevo',
        buttons: [
          {
            text: 'Gracias',
            cssClass: 'primary'
          }
        ]
      });
     
        alert2.dismiss();
        await alert2.present();
        this.router.navigate(['/menu/:user'], {state: history.state});
      }

      }
      }, error => {
      console.log("ERRRRRR" +  error.message);
    });
  }
}

back() {
  this.user = history.state;
  this.router.navigate(['/ofrecer/:user'], {state: this.user});
}
addRow(thiou){
    let n: number = this.product.length;
    console.log(thiou);
    let newIndex = this.product.length;

    this.product[newIndex] =  {
        'id' : '1',
      'product' : '',
      'productDescription': ''
    };

}
deleteRow(){
  let n: number = this.product.length;
  this.product.splice(n - 1);
}

openCam(){

  const options: CameraOptions = {
    quality: 100,
    destinationType: this.camera.DestinationType.DATA_URL,
    encodingType: this.camera.EncodingType.JPEG,
      mediaType: this.camera.MediaType.PICTURE
  }
  
  this.camera.getPicture(options).then((imageData) => {
    // imageData is either a base64 encoded string or a file URI
    // If it's base64 (DATA_URL):
    let filePath = imageData;
    this.image = 'data:image/jpeg;base64,' + imageData;

//     this.base64.encodeFile(filePath).then((base64File: string) => {
//     this.image='data:image/jpeg;base64,' + base64File;
//   }, (err) => {
// console.log(err);
// alert(err);
// });
    
  }, (err) => {
    // Handle error
    alert("error "+JSON.stringify(err))
  });

}

  async upload()
{
  const loading = await this.loadingController.create({
    message: 'Uploading...',
    });
  loading.present();

  const fileTransfer: FileTransferObject = this.transfer.create();
  let today: Date = new Date();
  this.imagePath = today.getFullYear()+""+today.getMonth()+""+today.getDate()+""+today.getHours()+""+today.getMinutes()+""+today.getSeconds()+""+'.jpg';
  
  let options1: FileUploadOptions = {
      fileKey: 'file',
      fileName: this.imagePath,
      headers: {}
  
  };

  await fileTransfer.upload(this.image, 'https://lanzalibre.000webhostapp.com/upload.php', options1)
.then((data) => {
  // success
  loading.dismiss();
}, (err) => {
  // error
  alert('error' + JSON.stringify(err));
  loading.dismiss();
});
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
