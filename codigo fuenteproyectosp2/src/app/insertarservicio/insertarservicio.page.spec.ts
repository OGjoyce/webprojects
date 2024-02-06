import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InsertarservicioPage } from './insertarservicio.page';

describe('InsertarservicioPage', () => {
  let component: InsertarservicioPage;
  let fixture: ComponentFixture<InsertarservicioPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InsertarservicioPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InsertarservicioPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
