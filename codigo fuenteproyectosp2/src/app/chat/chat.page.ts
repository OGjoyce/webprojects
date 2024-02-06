import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { AlertController, IonContent } from '@ionic/angular';
@Component({
  selector: 'app-chat',
  templateUrl: './chat.page.html',
  styleUrls: ['./chat.page.scss'],
})
export class ChatPage implements OnInit {
  message: string = "escribe aqui tu mensaje...";
  emiter: any;
  sender: any;
  mensajes: any;
  username = 'hello';
  lista: any;
  productoID: any;
  constructor(public httpClient: HttpClient, public alertController: AlertController, public router: Router) { }
   imagevar = '../../assets/users/user.png';
  ngOnInit() {
    console.log(history.state);
    this.sender = history.state.id;
    this.emiter = history.state.external;
    this.username = history.state.externalname;
    this.productoID = history.state.externalProduct;
    console.log(history.state);
    
    console.log(history.state.externalname + "23");
    this.getMessages();    
    this.doSomething().then(truthy => {  });
   
  }

  back() {
    this.router.navigate(['/elegance/:user'], {state: history.state});
  }
  makeRequest(msg){
    const token = 'mensajeria';
    this.httpClient.get(`https://lanzalibre.000webhostapp.com/contact.php?&token=${token}&sender=${this.sender}&emiter=${this.emiter}&msg=${this.message}`)
    .subscribe(async data => {
      if ( data == null) {
      } else {
        if(data === 1){
          console.log('mensaje enviado');
        }else{
          console.log("error");
        }

      }
     }, error => {
      console.log(error);
    });
  }
  async sendMessage(){
   if(this.message!=null){
     this.makeRequest(this.message);
     this.message="";
   }
  }
  clearText(){
    this.message ="";
  }

  //esperar cada 5 segundos
  async doSomething(){
    return new Promise((resolve, reject)=> {
      
       setTimeout(() => { resolve(true);
                          this.getMessages();
                          this.doSomething().then(truthy => { console.log('finished'); });
       }, 5000);
       
    });
    
 }
 getMessages(){
   const token = "getmsgs";
   this.httpClient.get(`https://lanzalibre.000webhostapp.com/contact.php?&token=${token}&sender=${this.sender}&emiter=${this.emiter}`)
  .subscribe(async data => {
    if ( data == null) {
      console.log("null data");
    } else {
      let leng : number = Object.keys(data).length;
      this.mensajes = data;

    }
   }, error => {
    console.log(error);
  });
   

 }
 async handleFinish(){
  const alert1 = await this.alertController.create({
    header: '¡Atención!',
    message: 'Califica a esta persona en una escala del 1 al 5.',
    inputs: [
      {
        name: 'radio1',
        type: 'radio',
        label: '1',
        value: '1',

      },
      {
        name: 'radio2',
        type: 'radio',
        label: '2',
        value: '2',

      },
      {
        name: 'radio3',
        type: 'radio',
        label: '3',
        value: '3',

      },
      {
        name: 'radio4',
        type: 'radio',
        label: '4',
        value: '4',

      },
      {
        name: 'radio5',
        type: 'radio',
        label: '5',
        value: '5',
        checked: true
      },
    ],
    buttons: [
      {
        text: 'Si',
        role: 'accept',
        cssClass: 'primary',
        handler: (blah) => {
        const token = "insertRank";
        this.httpClient.get(`https://lanzalibre.000webhostapp.com/servicios.php?&token=${token}&maestro=${this.sender}&esclavo=${this.emiter}&punteo=${blah}&productid=${this.productoID}`)
        .subscribe(async data => {
        if ( data == null) {
        console.log("null data");
        } else {

        }
        }, error => {
        console.log(error);
        });

        }
      }, {
        text: 'No',
        handler: () => {
        }
      }
    ]
  });
  await alert1.present();
   }

}
