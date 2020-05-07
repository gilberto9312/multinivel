CREATE TABLE IF NOT EXISTS `vendedors` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
  `nombres` varchar(50) not null COMMENT 'nombre cliente',
  `cod_parent` int(9) default null,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `ventas_vendedors` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
  `id_vendedor` int(11) not null,
  `monto` float(11,2) default 0.0,
  `date` date,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `comision_ventas_vendedors` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
  `id_vendedor` int(11) not null,
  `id_veta` int(11) not null,
  `monto` float(11,2) default 0.0,
  `date` date,
  PRIMARY KEY (`id`)
);

