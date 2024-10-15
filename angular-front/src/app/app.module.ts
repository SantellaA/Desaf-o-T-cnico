import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ReservaListComponent } from './Reserva/reserva-list/reserva-list.component';
import { EspacioCreateComponent } from './Espacio/espacio-create/espacio-create.component';
import { EspacioShowComponent } from './Espacio/espacio-show/espacio-show.component';
import { EspacioEditComponent } from './Espacio/espacio-edit/espacio-edit.component';
import { LandingPageComponent } from './landing-page/landing-page.component';

@NgModule({
  declarations: [
    AppComponent,
    ReservaListComponent,
    EspacioCreateComponent,
    EspacioShowComponent,
    EspacioEditComponent,
    LandingPageComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
