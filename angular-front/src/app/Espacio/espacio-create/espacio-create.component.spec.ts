import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EspacioCreateComponent } from './espacio-create.component';

describe('EspacioCreateComponent', () => {
  let component: EspacioCreateComponent;
  let fixture: ComponentFixture<EspacioCreateComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EspacioCreateComponent]
    });
    fixture = TestBed.createComponent(EspacioCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
