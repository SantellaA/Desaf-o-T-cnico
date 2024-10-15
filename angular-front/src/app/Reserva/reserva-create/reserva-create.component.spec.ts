import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ReservaCreateComponent } from './reserva-create.component';

describe('ReservaCreateComponent', () => {
  let component: ReservaCreateComponent;
  let fixture: ComponentFixture<ReservaCreateComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ReservaCreateComponent]
    });
    fixture = TestBed.createComponent(ReservaCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
