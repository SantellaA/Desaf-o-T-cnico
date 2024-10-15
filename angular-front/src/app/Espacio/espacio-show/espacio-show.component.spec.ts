import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EspacioShowComponent } from './espacio-show.component';

describe('EspacioShowComponent', () => {
  let component: EspacioShowComponent;
  let fixture: ComponentFixture<EspacioShowComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EspacioShowComponent]
    });
    fixture = TestBed.createComponent(EspacioShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
