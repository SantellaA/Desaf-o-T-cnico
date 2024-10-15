import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LandingPageComponent } from './landing-page/landing-page.component';
//Reservas
import { ReservaListComponent } from './Reserva/reserva-list/reserva-list.component';
import { ReservaCreateComponent } from './Reserva/reserva-create/reserva-create.component';
import { ReservaEditComponent } from './Reserva/reserva-edit/reserva-edit.component';
//Espacios
import { EspacioListComponent } from './Espacio/espacio-list/espacio-list.component';
import { EspacioCreateComponent } from './Espacio/espacio-create/espacio-create.component';
import { EspacioShowComponent } from './Espacio/espacio-show/espacio-show.component';
import { EspacioEditComponent } from './Espacio/espacio-edit/espacio-edit.component';

const routes: Routes = [
  { path: '', component: LandingPageComponent, title : 'Espacios Pipo'},
  //Reservas
  { path: 'reserva', component: ReservaListComponent, title : 'Espacios Pipo - Reservas'},
  { path: 'reserva/create', component: ReservaCreateComponent, title : 'Espacios Pipo - Reservas'},
  { path: 'reserva/edit', component: ReservaEditComponent, title : 'Espacios Pipo - Reservas'},
  //Espacios
  { path: 'espacio', component: EspacioListComponent, title : 'Espacios Pipo - Espacios'},
  { path: 'espacio/create', component: EspacioCreateComponent, title : 'Espacios Pipo - Espacios'},
  { path: 'espacio/show', component: EspacioShowComponent, title : 'Espacios Pipo - Espacios'},
  { path: 'espacio/edit', component: EspacioEditComponent, title : 'Espacios Pipo - Espacios'},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
