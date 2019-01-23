import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

import { Car } from './car';
import { Rendu } from './rendu';
import { Rend } from './rend';
@Injectable({
  providedIn: 'root'
})
export class CarService {
  baseUrl = 'http://localhost/api2';
cars: Car[];
rendu: Rendu[];
rend: Rend[];
constructor(private http: HttpClient) { }

  getAll(): Observable<Car[]> {
    return this.http.get(`${this.baseUrl}/list`).pipe(
      map((res) => {
        this.cars = res['data'];
        return this.cars;
    }),
    catchError(this.handleError));
  }
  getAllr(): Observable<Rendu[]> {
    return this.http.get(`${this.baseUrl}/listr`).pipe(
      map((res) => {
        this.rendu = res['data'];
        return this.rendu;
    }),
    catchError(this.handleError));
  }
 
  updatetout(): Observable<Rend[]> {
    return this.http.get(`${this.baseUrl}/listdeja`).pipe(
      map((res) => {
        this.rend = res['data'];
        return this.rend;
    }),
    catchError(this.handleError));
  }
  
  
  
  store(car: Car): Observable<Car[]> {
    return this.http.post(`${this.baseUrl}/store`, { data: car })
      .pipe(map((res) => {
        this.cars.push(res['data']);
        return this.cars;
      }),
      catchError(this.handleError));
  }

  update(car: Car): Observable<Car[]> {
    return this.http.put(`${this.baseUrl}/update`, { data: car })
      .pipe(map((res) => {
        const theCar = this.cars.find((item) => {
          return +item['id'] === +car['id'];
        });
        if (theCar) {
          theCar['moyenne'] = car['moyenne'];
		  theCar['num_id'] = car['num_id'];
		  theCar['dle'] = car['dle'];
		  theCar['aps'] = car['aps'];
		  theCar['arv'] = car['arv'];
		  theCar['ihm'] = car['ihm'];
		  theCar['fdt'] = car['fdt'];
		  theCar['ars'] = car['ars'];
        }
        return this.cars;
      }),
      catchError(this.handleError));
  }
  
  updater(rendu: Rendu): Observable<Rendu[]> {
    return this.http.put(`${this.baseUrl}/updater`, { data: rendu })
      .pipe(map((res) => {
        const theRendu = this.rendu.find((item) => {
          return +item['id'] === +rendu['id'];
        });
        if (theRendu) {
          theRendu['option_choix'] = rendu['option_choix'];
		  theRendu['premier'] = rendu['premier'];
		  theRendu['deuxieme'] = rendu['deuxieme'];
		  theRendu['troisieme'] = rendu['troisieme'];
		  theRendu['quatrieme'] = rendu['quatrieme'];
		  theRendu['cinquieme'] = rendu['cinquieme'];
	     }
        return this.rendu;
      }),
      catchError(this.handleError));
  }

  delete(id: number): Observable<Car[]> {
    const params = new HttpParams()
      .set('id', id.toString());

    return this.http.delete(`${this.baseUrl}/delete`, { params: params })
      .pipe(map(res => {
        const filteredCars = this.cars.filter((car) => {
          return +car['id'] !== +id;
        });
        return this.cars = filteredCars;
      }),
      catchError(this.handleError));
  }

  private handleError(error: HttpErrorResponse) {
    console.log(error);

    // return an observable with a user friendly message
    return throwError('Error! something went wrong.');
  }
}
