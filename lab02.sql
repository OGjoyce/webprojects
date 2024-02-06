Create login jperez with password='987ZYX';
Create login pjuarez with password='123ABC';
Create database Universidad;
CREATE TABLE Estudiante
( carnet integer,
 enombre char(80),
 ciclo integer,
 edad integer,
 PRIMARY KEY (carnet));
CREATE TABLE Facultad
( fid integer,
 fnombre char(30),
 PRIMARY KEY (fid));
CREATE TABLE Curso
( idcurso integer,
 cnombre char(40),
 aula char(5),
 fid integer,
 PRIMARY KEY (idcurso),
 FOREIGN KEY (fid) REFERENCES Facultad);
CREATE TABLE Asignacion
( carnet integer,
 idcurso integer,
 PRIMARY KEY (carnet, idcurso),
 FOREIGN KEY (carnet) REFERENCES Estudiante,
 FOREIGN KEY (idcurso) REFERENCES Curso);

 Create user facultad for login jperez;
  Create user estudiante for login pjuarez;

  create view ListadoAsignaciones as
  select E.enombre, C.cnombre 
  from Estudiante E, Curso C, Asignacion A
  where A.carnet = E.carnet and A.idcurso = C.idcurso;

GRANT insert, delete,select on curso to facultad;
GRANT select on ListadoAsignaciones to facultad;

GRANT select on ListadoAsignaciones to Estudiante;
create view MisAsignaciones as 
Select E.carnet, C.cnombre
from Estudiante E, Curso C, Asignacion A
Where E.carnet = A.carnet;

Grant select, insert on MisAsignaciones to Estudiante;