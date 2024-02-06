import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';
import { Injectable } from '@angular/core';
import { IonicModule } from '@ionic/angular';

import { InsertarservicioPage } from './insertarservicio.page';
import { HttpClientModule } from '@angular/common/http';
const routes: Routes = [
  {
    path: '',
    component: InsertarservicioPage
  }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    HttpClientModule,
    RouterModule.forChild(routes)
  ],
  declarations: [InsertarservicioPage]
})
export class InsertarservicioPageModule {}
