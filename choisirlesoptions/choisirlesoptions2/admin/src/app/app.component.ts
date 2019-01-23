import { Component, OnInit } from '@angular/core';

import { Car } from './car';
import { Rendu } from './rendu';
import { Rend } from './rend';
import { CarService } from './car.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  cars: Car[];
  rendu: Rendu[];
  rend: Rend[];
  error = '';
  success = '';

  car = new Car(0,0,0,0,0,0,0,0,0);

  constructor(private carService: CarService) {
  }

  ngOnInit() {
    this.getCars();
	this.getRendu();
  }

  getCars(): void {
    this.carService.getAll().subscribe(
      (res: Car[]) => {
        this.cars = res;
      },
      (err) => {
        this.error = err;
      }
    );
  }
  getRendu(): void {
    this.carService.getAllr().subscribe(
      (res: Rendu[]) => {
        this.rendu = res;
      },
      (err) => {
        this.error = err;
      }
    );
  }
  
  
  addCar(f) {
    this.resetErrors();

    this.carService.store(this.car)
      .subscribe(
        (res: Car[]) => {
          // Update the list of cars
          this.cars = res;

          // Inform the user
          this.success = 'Created successfully';

          // Reset the form
          f.reset();
        },
        (err) => this.error = err
      );
  }

  updateCar(moyenne, id,num_id,dle,aps,arv,ihm,fdt,ars) {
    this.resetErrors();

    this.carService.update({  moyenne: moyenne.value, id: +id, num_id: num_id.value,dle: dle.value,aps: aps.value,arv:arv.value,ihm:ihm.value,fdt:fdt.value,ars:ars.value })
      .subscribe(
        (res) => {
          this.cars    = res;
          this.success = 'Updated successfully';
        },
        (err) => this.error = err
      );
  }
  
  updateRendu(id,option_choix, premier,deuxieme,troisieme,quatrieme,cinquieme) {
    this.resetErrors();

    this.carService.updater({id: +id,  option_choix: option_choix.value, premier: premier.value,deuxieme: deuxieme.value,troisieme: troisieme.value,quatrieme:quatrieme.value,cinquieme:cinquieme.value})
      .subscribe(
        (res) => {
          this.rendu    = res;
          this.success = 'Updated successfully';
        },
        (err) => this.error = err
      );
  }

  updatetout(): void {
    this.carService.updatetout().subscribe(
      (res: Rend[]) => {
        this.rend = res;
      },
      (err) => {
        this.error = err;
      }
    );
  }
  
  deleteCar(id) {
    this.resetErrors();

    this.carService.delete(+id)
      .subscribe(
        (res: Car[]) => {
          this.cars = res;
          this.success = 'Deleted successfully';
        },
        (err) => this.error = err
      );
  }

  private resetErrors(){
    this.success = '';
    this.error   = '';
  }

}
