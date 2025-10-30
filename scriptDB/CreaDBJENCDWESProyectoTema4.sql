CREATE DATABASE IF NOT EXISTS DBJENCDWESProyectoTema4;

CREATE TABLE IF NOT EXISTS DBJENCDWESProyectoTema4.Departamento (
    CodDepartamento VARCHAR(3) PRIMARY KEY,
    DescDepartamento VARCHAR(255),
    FechaCreacionDepartamento DATETIME,
    VolumenDeNegocio FLOAT,
    FechaBajaDepartamento DATETIME
) engine = innodb;

CREATE USER IF NOT EXISTS 'userJENCDWESProyectoTema4'@'%' IDENTIFIED BY 'paso';

GRANT ALL PRIVILEGES ON DBJENCDWESProyectoTema4.* TO 'userJENCDWESProyectoTema4' @'%';