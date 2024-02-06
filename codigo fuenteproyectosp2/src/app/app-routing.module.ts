import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)},
  { path: 'register', loadChildren: './register/register.module#RegisterPageModule' },
  { path: 'menu/:user', loadChildren: './menu/menu.module#MenuPageModule' },
  { path: 'menu', loadChildren: './menu/menu.module#MenuPageModule' },
  { path: 'autenticar', loadChildren: './autenticar/autenticar.module#AutenticarPageModule' },
  { path: 'autenticar/:user', loadChildren: './autenticar/autenticar.module#AutenticarPageModule' },
  { path: 'buscar', loadChildren: './buscar/buscar.module#BuscarPageModule' },
  { path: 'buscar/:user', loadChildren: './buscar/buscar.module#BuscarPageModule' },
  { path: 'ofrecer', loadChildren: './ofrecer/ofrecer.module#OfrecerPageModule' },
  { path: 'ofrecer/:user', loadChildren: './ofrecer/ofrecer.module#OfrecerPageModule' },
  { path: 'home-home', loadChildren: './home-home/home-home.module#HomeHomePageModule' },
  { path: 'home-home/:user', loadChildren: './home-home/home-home.module#HomeHomePageModule' },
  { path: 'insertarservicio', loadChildren: './insertarservicio/insertarservicio.module#InsertarservicioPageModule' },
  { path: 'insertarservicio/:user', loadChildren: './insertarservicio/insertarservicio.module#InsertarservicioPageModule' },
  { path: 'agregar', loadChildren: './agregar/agregar.module#AgregarPageModule' },
  { path: 'agregar/:user', loadChildren: './agregar/agregar.module#AgregarPageModule' },
  { path: 'elegance/:user', loadChildren: './elegance/elegance.module#ElegancePageModule' },
  { path: 'elegance', loadChildren: './elegance/elegance.module#ElegancePageModule' },
  { path: 'chat', loadChildren: './chat/chat.module#ChatPageModule' },
  { path: 'chat/:user', loadChildren: './chat/chat.module#ChatPageModule' },
  { path: 'profile', loadChildren: './profile/profile.module#ProfilePageModule' },
  { path: 'profile/:user', loadChildren: './profile/profile.module#ProfilePageModule' },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
