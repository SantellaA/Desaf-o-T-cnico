import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EspacioEditComponent } from './espacio-edit.component';

describe('EspacioEditComponent', () => {
  let component: EspacioEditComponent;
  let fixture: ComponentFixture<EspacioEditComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EspacioEditComponent]
    });
    fixture = TestBed.createComponent(EspacioEditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
