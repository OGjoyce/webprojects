import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { HomeHomePage } from './home-home.page';

describe('HomeHomePage', () => {
  let component: HomeHomePage;
  let fixture: ComponentFixture<HomeHomePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ HomeHomePage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(HomeHomePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
