-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 03:27:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos`
--

CREATE TABLE `capitulos` (
  `id_capitulo` int(11) NOT NULL,
  `titulo_cap` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `numero_cap` int(11) NOT NULL,
  `id_temp_fk` int(11) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `capitulos`
--

INSERT INTO `capitulos` (`id_capitulo`, `titulo_cap`, `descripcion`, `numero_cap`, `id_temp_fk`, `img`) VALUES
(1, 'Principio del fin', 'Un profesor de química de escuela secundaria recurre a la venta de drogas para mantener a su familia', 1, 1, 'imagen_db/63482010de4e1.jpg'),
(3, 'Y la bolsa en el rio', 'Mientras Walt limpia el desorden que quedó tras su primer negocio de drogas, piensa en decirle a Skyler la verdad sobre su enfermedad.\r\n\r\n', 3, 1, 'imagen_db/634821889a3d3.jpg'),
(4, 'Cancer', 'Al ser forzado a contar la verdad acerca de su enfermedad, Walt enfrenta el problema de cómo pagar una serie de caros tratamientos contra el cáncer.\r\n\r\n', 4, 1, 'imagen_db/634821965f136.jpg'),
(5, 'Materia gris', 'Skyler organiza una intervención para convencer a Walt de que acepte la generosa oferta de su excompañero de investigaciones de pagar el tratamiento contra el cáncer.\r\n\r\n', 5, 1, 'imagen_db/634821a189816.jpg'),
(6, 'Un loco puniado de nada', ' Los efectos secundarios y el costo del tratamiento crecen, y Walt exige que Jesse encuentre un revendedor para sus drogas; Jesse termina en problemas con un exconvicto.\r\n\r\n', 6, 1, 'imagen_db/634b4835cd2b2.jpg'),
(7, 'Acuerdo no violento', 'Tras el encuentro cercano de Jesse con la muerte, Walt acepta producir más drogas para Tuco, mientras Skyler sospecha que su hermana robó un costoso regalo para bebés.\r\n\r\n', 7, 1, 'imagen_db/634b48406d97f.jpg'),
(9, 'A las brasas', 'Mientras la DEA pone en marcha la búsqueda de Tuco, Skyler recurre a Hank para que la ayude a encontrar a Walt.\r\n\r\n', 2, 2, 'imagen_db/634b49898fec1.jpg'),
(10, 'Picadura de una abeja muerta', 'Walt intenta volver a acercarse a Skyler, y Jesse se encuentra sin hogar después de que sus padres lo echan de su casa.\r\n\r\n', 3, 2, 'imagen_db/634b4998cfe2a.jpg'),
(11, 'Abajo', 'Walt lucha por intentar salvar su relación con Skyler, y Jesse se queda sin hogar cuando sus padres lo desalojan.\r\n\r\n', 4, 2, 'imagen_db/634b49e766211.jpg'),
(12, 'Rotura', 'Hank trata de recobrar la compostura tras su encuentro con Tuco. Mientras, Jesse forma una pandilla para distribuir más producto por la ciudad.\r\n\r\n', 5, 2, 'imagen_db/634b49d7e887e.jpg'),
(13, 'Cucu', 'Jesse busca a los adictos que robaron las drogas a Skinny Pete, y Walt lucha por sostener su coartada para explicar cómo ha pagado el tratamiento de cáncer.\r\n\r\n', 6, 2, 'imagen_db/634b49f6ddeeb.jpg'),
(14, 'Negro y Azul', 'La reputación de narco implacable de Jesse lleva a Walt a ampliar sus actividades; la incursión de Hank en el mundo de la oficina de la DEA en El Paso lo estremece.\r\n\r\n', 7, 2, 'imagen_db/634b4a03612a2.jpg'),
(15, 'Llama a Saul!', 'El arresto de Badger obliga a Walt y Jesse a contratar a un abogado de mala reputación.\r\n\r\n\r\n', 8, 2, 'imagen_db/634b4a17ba8d8.jpg'),
(16, 'Cuatro dias afuera', 'Preocupado porque no le queda mucha vida, Walt intenta cubrir las necesidades de su familia en una maratónica sesión de preparación de metanfetamina con Jesse.\r\n\r\n', 9, 2, 'imagen_db/634b4a387fcb6.jpg'),
(17, 'Terminado', 'Al recibir buenas noticias sobre el tratamiento de cáncer, Walt acude a su cuñado, Hank, antes de centrar su atención en hacer las cosas bien en su hogar.\r\n\r\n', 10, 2, 'imagen_db/634b4a43d2d24.jpg'),
(18, 'Mandala', 'Skyler tiene conflictos por sus sentimientos hacia su jefe. La muerte de un vendedor callejero fuerza a Walt a buscar otro lugar para vender la metanfetamina.\r\n\r\n', 11, 2, 'imagen_db/634b4a5302a6d.jpg'),
(19, 'Phoenix', 'Walt intenta encaminar su vida y la de Jesse mientras se prepara para la cirugía y pretende esconder la procedencia de su dinero a Skyler y Walt Jr.\r\n\r\n', 12, 2, 'imagen_db/634b4a63df816.jpg'),
(20, 'ABQ', 'Walt intenta encaminar su vida y la de Jesse mientras se prepara para la cirugía y pretende esconder la procedencia de su dinero a Skyler y Walt Jr.\r\n\r\n', 13, 2, 'imagen_db/634b4a7c06280.jpg'),
(21, 'No mas', 'Tras el desastre aéreo de Albuquerque, Skyler obliga a Walt a mudarse, mientras la estadía de Jesse en rehabilitación lo ayuda a aceptar su rol en el fatal choque aéreo.\r\n\r\n', 1, 3, ''),
(22, 'Caballo sin nombre', 'Skyler está decidida a divorciarse, y Walt acaba en la mira de dos asesinos de un cártel mexicano que buscan venganza.\r\n\r\n', 2, 3, ''),
(23, 'T. S. T.', 'Jesse se cuestiona volver al negocio de las drogas ya que una organización de narcotraficantes espera con ansias vengar la muerte de uno de sus miembros.\r\n\r\n', 3, 3, ''),
(24, 'Luz verde', 'Mientras el romance de Skyler con su jefe crea caos en su matrimonio, un lote de metanfetamina que devuelve a Jesse al negocio involucra inadvertidamente a Walt.\r\n\r\n', 4, 3, ''),
(25, 'Más', 'Walt considera una oferta para regresar al narcotráfico; la obsesión de Hank por atrapar a \"Heisenberg\" trae problemas para Jesse.\r\n\r\n', 5, 3, ''),
(26, 'Atardecer', 'Walt vuelve al narcotráfico en el laboratorio de Gus, pero el descubrimiento de su vieja casa rodante lo fuerza a él y a Jesse a actuar para que Hank no los descubra.\r\n\r\n', 6, 3, ''),
(27, 'Un minuto', 'Hank, enojado, arriesga su carrera al atacar a Jesse; Walt, preocupado de que Jesse hable, le da un lugar en su laboratorio.\r\n\r\n', 7, 3, ''),
(28, 'Te veo', 'Mientras Hank se aferra a la vida, Walt descubre que los matones pueden estar tras él y busca alejarse de los problemas tomando a Jesse como compañero.\r\n\r\n', 8, 3, ''),
(29, 'Kafkiano', 'Al retomar la producción junto a Walt, Jesse piensa cómo aumentar las ganancias; la recuperación de Hank pone a Marie en una situación difícil con la compañía de seguros.\r\n\r\n', 9, 3, ''),
(30, 'Vuelo', 'Walt y Jesse se enfrentan a una larga noche en el laboratorio... y a una fastidiosa mosca.\r\n\r\n\r\n', 10, 3, ''),
(31, 'Abiquiú', 'Hank no está contento con su recuperación; Skyler cuestiona el negocio de lavado de dinero de Saul, y Jesse se enamora de una compañera de rehabilitación.\r\n\r\n', 11, 3, ''),
(32, 'Medias medidas', 'Jesse va tras los narcos que mataron a Combo, Hank se niega a dejar el hospital y Skyler presiona a Walt para que acepte el negocio de lavado de dinero.\r\n\r\n', 12, 3, ''),
(33, 'Medidas totales', 'Luego de liquidar a dos traficantes de su jefe, Walt se da cuenta de que Gus planea matarlo y reemplazarlo con su anterior asistente.\r\n\r\n', 13, 3, ''),
(34, 'Navaja', 'Después de luchar por sus vidas en una turbulenta situación, Walt y Jesse esperan con ansiedad la próxima jugada de Gus.\r\n\r\n', 1, 4, ''),
(35, 'Revólver calibre 38', 'Mientras Walt prepara su defensa contra Gus, Jesse hace frente a la presión renovando su amistad con Badger y Skinny Pete.\r\n\r\n', 2, 4, ''),
(36, 'Casa abierta', 'Mientras Walt se preocupa acerca de la intromisión de Gus y la salud mental de Jesse, cada vez más frágil, Skyler aumenta la presión para obtener lo que quiere.\r\n\r\n', 3, 4, ''),
(37, 'Puntos clave', 'Mientras Skyler arma una historia elaborada para explicar las finanzas de los White, Walt, preocupado, descubre que Hank ha comenzado una nueva investigación.\r\n\r\n', 4, 4, ''),
(38, 'Copiloto', 'Jesse acompaña como copiloto a Mike en una riesgosa serie de picadas, lo que hace que Walt se preocupe por la posible muerte de su socio.\r\n\r\n', 5, 4, ''),
(39, 'Arrinconados', 'Skyler adopta un enfoque reservado cuando sospecha que Walt no le está diciendo la verdad. Mientras tanto, Jesse prueba su valía ante Mike y Gus.\r\n\r\n', 6, 4, ''),
(40, 'Perro problemático', 'Obligado a devolver el auto que compró para su hijo, Walt responde poniendo en aprietos a Skyler con su nueva operación de lavado de dinero.\r\n\r\n', 7, 4, ''),
(41, 'Hermanos', 'Cuando Hank presenta evidencia de que Gus es el narcotraficante de metanfetamina de Albuquerque, a Walt le preocupa que los maten a él y a Jesse por proteger a su jefe.\r\n\r\n', 8, 4, ''),
(42, 'Micrófono', 'Mientras Walt intenta subvertir la investigación de Hank sobre la escena de Albuquerque, una advertencia mortal fuerza a Gus a considerar un trato con el cártel mexicano.\r\n\r\n', 9, 4, ''),
(43, 'Salud', 'Mientras Walt, maltratado, aún se recupera de la pelea, Gus se lleva a Jesse con él a México para cerrar un trato con el cártel.\r\n\r\n', 10, 4, ''),
(44, 'Entrepiso', 'Mientras Skyler presiona a Ted para que acepte su dinero y pueda pagar los impuestos, Gus sostiene que Jesse debería reanudar su trabajo en el laboratorio él solo.\r\n\r\n', 11, 4, ''),
(45, 'Fin de los tiempos', 'Mientras le ordena a su familia que aproveche la protección que la DEA le ofrece a Hank, Walt espera el destino que le toque.\r\n\r\n', 12, 4, ''),
(46, 'Cara a cara', 'Cuando su plan de matar a Gus fracasa, Walt y Jesse deben actuar rápido para cubrir sus rastros y evitar la muerte.\r\n\r\n', 13, 4, ''),
(47, 'Vive libre o muere', 'Walt visita a su familia, que aún está en custodia, mientras debe lidiar con las secuelas de la explosión en Casa Tranquila.\r\n\r\n', 1, 5, ''),
(48, 'Madrigal', 'Walt y Jesse deciden buscar un nuevo compañero para que los ayude en su último proyecto, y la DEA investiga varias pistas con la esperanza de encontrar algo certero.\r\n\r\n', 2, 5, ''),
(49, 'Peligro', 'Para consternación de Skyler, Walter vuelve a vivir a la casa. Walter, Mike y Jesse se reúnen con Saul para pedirle que les encuentre un nuevo lugar para cocinar.\r\n\r\n', 3, 5, ''),
(50, ' 51 (Cincuenta y uno)', 'Lydia se ve forzada a entregar a su propio empleado a la DEA, y Mike le ofrece un reemplazante: Jesse. Walt y Skyler discuten sobre si la familia corre peligro.\r\n\r\n', 4, 5, ''),
(51, ' Carga de muerte', 'Mike y Lydia trabajan para transportar la metilamina necesaria para la operación. Walt y Jesse intentan elaborar un plan que no arruine su tapadera.\r\n\r\nMike y Lydia trabajan para transportar la metilamina necesaria para la operación. Walt y Jesse intentan', 5, 5, ''),
(52, 'Adquisición', 'Walt, Mike y Jesse lidian con las repercusiones del robo de la metilamina. Mike y Jesse quieren salirse del negocio, pero Walt está decidido a construir su imperio.\r\n\r\n', 6, 5, ''),
(53, 'Di mi nombre', 'Walter intenta iniciar un trato con Declan, y Hank —quien tuvo que dejar ir a Mike— ahora tiene en la mira al abogado que ha estado pagando a los hombres de Mike.\r\n\r\n', 7, 5, ''),
(54, ' Planeando sobre todos', 'Walt se encuentra con Lydia para conseguir los nombres de la gente de Mike que está en la cárcel. Skyler hace otro intento por convencer a Walt de que deje de cocinar.\r\n\r\n', 8, 5, ''),
(55, 'Dinero sangriento', 'A medida que Walt y Jesse se adaptan a la vida fuera del negocio, Hank se aferra a una inquietante pista.\r\n\r\n', 9, 5, ''),
(56, 'Enterrado', 'Mientras el pasado atormenta a Skyler, Walt cubre sus huellas, y Jesse continúa luchando con la culpa.\r\n\r\n', 10, 5, ''),
(57, 'Confesiones', 'Jesse decide hacer un cambio, y Walt y Skyler intentan lidiar con una exigencia inesperada.\r\n\r\n', 11, 5, ''),
(58, 'Perro rabioso', 'Una extraña estrategia comienza a dar frutos, mientras se ponen en marcha planes que podrían darle un giro completo a la situación.\r\n\r\n', 12, 5, ''),
(59, 'Tohajiilee', 'La presión aumenta para Walt, de un modo que nunca habría esperado.\r\n\r\n', 13, 5, ''),
(60, 'Ozymandias', 'Todos deben enfrentar circunstancias radicalmente distintas. Todos, sin excepción.\r\n\r\n', 14, 5, ''),
(61, 'Pizarra de granito', 'Los sucesos que se iniciaron hace mucho tiempo marchan hacia una conclusión.\r\n\r\n', 15, 5, ''),
(62, 'Felina', 'El final de la serie.\r\n\r\n', 16, 5, ''),
(202, 'sos', 'eee', 1, 1, ''),
(203, 'sos', 'eee', 1, 1, ''),
(204, 'sos', 'eee', 1, 1, ''),
(210, 'sos', 'eee', 1, 1, ''),
(219, 'sos', 'eoe', 2, 1, ''),
(221, 'sos', 'eoe', 1, 1, ''),
(222, 'sos', 'eoe', 1, 1, ''),
(223, 'sos', 'eoe', 1, 1, ''),
(225, 'sos', 'eoe', 1, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `valoracion` tinyint(4) NOT NULL,
  `id_capitulo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentario`, `valoracion`, `id_capitulo_fk`) VALUES
(1, 'El capitulo 1 es una locuraaaa!', 1, 1),
(2, 'El capitulo tres no me gusto mucho!', 0, 3),
(3, 'el capitulo 4 mejoro bastante, no fue tan aburrido', 1, 4),
(4, 'Esta serie cada vez se pone mejor, el capitulo 5 fue muy bueno', 1, 5),
(5, 'capitulo recomendable', 1, 6),
(6, 'capitulo gooooddd', 1, 6),
(7, 'comment editado a capitulooo 7', 1, 6),
(11, 'comment editado a capitulooo n', 1, 7),
(21, 'capitulo good', 1, 1),
(22, 'capitulo good', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

CREATE TABLE `temporadas` (
  `id_temp` int(11) NOT NULL,
  `titulo_temp` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_estreno` year(4) NOT NULL,
  `numero_temp` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`id_temp`, `titulo_temp`, `descripcion`, `fecha_estreno`, `numero_temp`) VALUES
(1, 'Temporada 1', 'A medida que Walter construye su imperio, su esposa empieza a sospechar de su errática conducta, y la DEA inicia la búsqueda de un nuevo líder de la droga.', 2008, 1),
(2, 'Temporada 2', 'Walter y Jesse, llegan alto en el juego de las drogas, llamando la atención del cartel rival y poniendo en peligro a Hank; cuñado de Walter y agente de la DEA.', 2009, 2),
(3, 'Temporada 3', 'Pensando en su familia, Walter sigue cocinando metanfetamina en secreto. Mientras, Jesse, ex alumno de Walter, se ha hecho adicto a la heroína.', 2010, 3),
(4, 'Temporada 4', 'Bryan Cranston regresa en una nueva temporada como Walter White, quien sigue elaborando metanfetaminas e intentando superar al narcotraficante Gus Fring.', 2011, 4),
(5, 'Temporada 5', 'En la temporada final, Walt ya no tiene que esforzarse por ser malo. Su vida sigue en una espiral descendente que le lleva a lo más alto de un imperio de la droga.', 2012, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`) VALUES
(1, 'userharcod@email.com', '$2a$12$qE1FYHz9TKndADayjuxQ8ek1MEuiHCaflQlC0n19/MGP/Xvk2IKYS'),
(2, 'scuffilautaro@gmail.com', '$2a$12$qE1FYHz9TKndADayjuxQ8ek1MEuiHCaflQlC0n19/MGP/Xvk2IKYS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD PRIMARY KEY (`id_capitulo`),
  ADD KEY `id_temp_fk` (`id_temp_fk`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_comentario_fk` (`id_capitulo_fk`);

--
-- Indices de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  MODIFY `id_capitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD CONSTRAINT `capitulos_ibfk_1` FOREIGN KEY (`id_temp_fk`) REFERENCES `temporadas` (`id_temp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_capitulo_fk`) REFERENCES `capitulos` (`id_capitulo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
