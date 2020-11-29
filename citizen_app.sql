CREATE TABLE `base_course` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `base_course`
--

INSERT INTO `base_course` (`id`, `name`, `description`) VALUES
(1, 'Primero basico', 'Es el primer curso de todo '),
(2, 'segundo basico', 'es un curo mas abrazado '),
(3, 'Tercero básico ', 'se califica por difícil '),
(4, 'Cuarto basico', 'no se que agregar '),
(5, 'Quito basico', 'otro curso que no se como ira '),
(8, '1-C', 'Es el primer grado, sección C'),
(9, '1-A', 'es el primer grado, sección A'),
(10, '2-A', 'es el segundo grado, sección A'),
(11, '2-B', 'es el segundo grado, sección B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base_course_subject`
--

CREATE TABLE `base_course_subject` (
  `id` int(11) NOT NULL,
  `base_course_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `base_course_subject`
--

INSERT INTO `base_course_subject` (`id`, `base_course_id`, `subject_id`, `student_id`, `level_id`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 1, 4, 4),
(3, 1, 1, 2, 5),
(4, 2, 4, 3, 2),
(5, 1, 4, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `califications`
--

CREATE TABLE `califications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `calification` varchar(3) DEFAULT NULL,
  `craeted_at` date DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `califications`
--

INSERT INTO `califications` (`id`, `student_id`, `teacher_id`, `subject_id`, `calification`, `craeted_at`, `course_id`) VALUES
(1, 1, 5, 1, '5,1', NULL, 1),
(2, 1, 5, 1, '7,0', NULL, 1),
(3, 1, 5, 3, '4,4', '2020-11-14', 1),
(4, 7, 10, 5, '6,1', '2020-11-21', 1),
(5, 4, 5, 1, '6.3', '2020-11-13', 1),
(6, 3, 5, 4, '1,1', '2020-11-20', 1),
(7, 3, 5, 4, '4,2', '2020-12-02', 1),
(8, 3, 5, 4, '5,4', '2020-11-13', 1),
(9, 3, 10, 1, '4,0', '2020-11-21', 1),
(10, 3, 5, 4, '7,3', '2020-11-29', 2),
(11, 4, 5, 4, '50', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `group`
--

INSERT INTO `group` (`id`, `name`, `description`) VALUES
(1, '1B2020', 'Es el primer grado, sección B del año 2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_user`
--

CREATE TABLE `group_user` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `group_user`
--

INSERT INTO `group_user` (`id`, `student_id`, `group_id`) VALUES
(3, 4, 1),
(4, 3, 1),
(5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_course`
--

CREATE TABLE `history_course` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `level`
--

INSERT INTO `level` (`id`, `name`, `description`, `subject_id`) VALUES
(1, 'Muy mal', 'el estudiante presenta un muy bajo rendimiento académico en la signatura con un a probabilidad de reprobar 99%   ', 1),
(2, 'Mal', 'El estudiante presenta un rendimiento bajo que lo podría llevar a reprobar en caso de no darle apoyo 60% ', 1),
(3, 'Normal', 'El estudiante presenta un rendimiento normal el cual no es el mejor pero también no presenta riesgo de repetir es recomendarle esforzarse 50%  ', 1),
(4, 'Bien', 'El estudiante presenta un rendimiento bastante bueno destaca de los demás estudiantes por lo que no es necesario darle una atención demasiado alta 30%', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla`
--

CREATE TABLE `planilla` (
  `id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL,
  `base_course_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planilla`
--

INSERT INTO `planilla` (`id`, `group_id`, `base_course_id`, `teacher_id`, `year`) VALUES
(1, 1, 1, 5, 2020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Estudiante', NULL),
(2, 'Profesor', NULL),
(3, 'Apoderado', NULL),
(4, 'Gestor Plataforma', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sige_asistance`
--

CREATE TABLE `sige_asistance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `state` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sige_asistance`
--

INSERT INTO `sige_asistance` (`id`, `student_id`, `date`, `state`) VALUES
(1, 1, '2020-11-11', 1),
(2, 1, '2020-11-12', 0),
(3, 1, '2020-11-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sige_code` int(11) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`id`, `name`, `sige_code`, `description`) VALUES
(1, 'Matematicas', 1122334455, 'La matemática es un conjunto de lenguajes formales que pueden ser usados como herramienta para plantear problemas de manera no ambigua en contextos específicos. Por ejemplo, el siguiente enunciado podemos decirlo de dos formas: X es mayor que Y e Y es mayor que Z, o forma simplificada podemos decir que X > Y > Z. Este es el motivo por el cual las matemáticas son tan solo un lenguaje simplificado con una herramienta para cada problema específico (por ejemplo 2x2=4, o 2+2=4).'),
(2, 'Lenguage', 66778899, 'Desde un punto de vista más amplio, la comunicación indica una característica común a los humanos y a otros animales (animales no simbólicos) para expresar experiencias mediante el uso de señales y sonidos registrados por los órganos de los sentidos. Los seres humanos desarrollan un lenguaje simbólico complejo que se expresa con secuencias sonoras y signos gráficos. Por su parte, los animales se comunican a través de signos sonoros, olfativos y corporales que en muchos casos distan de ser sencillos.'),
(3, 'Historia', 99887766, 'La historia es la ciencia que tiene como objetivo el estudio de sucesos del pasado, tradicionalmente de la humanidad​, y como método, el propio de las ciencias sociales/humanas, así como el de las ciencias naturales en un marco de interdisciplinariedad.​ '),
(4, 'Ingles', 112233, 'El inglés es el idioma más hablado por número total de hablantes, con más de mil millones de hablantes.3​4​ Sin embargo, el inglés es el tercer idioma nativo más extendido en el mundo, después del mandarín y el español. Es el idioma más aprendido y es el idioma oficial o uno de los idiomas oficiales en casi 60 Estados soberanos.5​'),
(5, 'Ciencias', 54562123, 'La ciencia (del latín scientĭa, ‘conocimiento’) es un sistema ordenado de conocimientos estructurados que estudia, investiga e interpreta los fenómenos naturales, sociales y artificiales.1​ El conocimiento científico se obtiene mediante observación y experimentación en ámbitos específicos. Dicho conocimiento es organizado y clasificado sobre la base de principios explicativos, ya sean de forma teórica o práctica. A partir de estos se generan preguntas y razonamientos, se formulan hipótesis, se deducen principios y leyes científicas, y se construyen modelos científicos, teorías científicas y sistemas de conocimientos por medio de un método científico.2​'),
(6, 'Quimica', 537362384, 'Quimica es el ramo donde se puedes crear meta con tu profe'),
(7, NULL, NULL, NULL),
(8, NULL, NULL, NULL),
(9, NULL, NULL, NULL),
(10, NULL, NULL, NULL),
(11, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `rut` varchar(25) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `lastname_p` varchar(30) DEFAULT NULL,
  `lastname_m` varchar(30) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `commune` varchar(30) DEFAULT NULL,
  `password` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `prioritary` int(11) DEFAULT NULL,
  `representative_id` int(11) DEFAULT NULL,
  `representative_supp_id` int(11) DEFAULT NULL,
  `contact_movil` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `rut`, `name`, `lastname_p`, `lastname_m`, `email`, `phone`, `address`, `rol_id`, `commune`, `password`, `course_id`, `prioritary`, `representative_id`, `representative_supp_id`, `contact_movil`) VALUES
(1, '20.135.555-5', 'Andres', 'Lopez', 'Ramirez', 'pegasominecraft@gmail.com', '962667624', 'Sector loma atravesada', 1, 'Yungay', 77948294, 1, 0, 3, 2, '1111111'),
(2, '11.111.111-1', 'Cristian', 'Arias', '0', 'kriss12ngmail.com', '346851654', 'santa amelia 23145', 3, 'Chillan', 77948294, 0, 0, 0, 4, '94824685'),
(3, '70.058.220-5', 'Edgar', 'Alfonso', 'Cifuentes', 'pepenitro@gmail.com', '954132484', 'en algun lugar de chile', 1, 'santiago', 542139874, 2, 0, 0, 0, '643128421'),
(4, '14.659.874-9', 'cocho', 'manco', 'alberto', 'eldelasbuenas@gmail.com', '87412369845', 'en una parte que no se donde es pero me dijo que era ahi ', 1, 'Santiago', 1548321, 1, 0, 1, 2, '9874653125'),
(5, '98.002.541-1', 'Rodrigo', 'Herrera ', '0', 'rodrixhdbienpellaco@gmail.com', '823971546', 'En las condes de chillan 201 ya desperto del sueño', 2, 'Chillan', 90, 0, 0, 0, 0, '97845863142'),
(6, '14.321.564-k', 'Andrés', 'Alejandro', 'Cepulbeda', NULL, '975995258', 'Yungay/Camino San Antonio', 3, 'yungay', NULL, 0, 0, 0, 0, '975995258'),
(7, '7.321.954-l', 'Javier', 'Lopez', 'Ramirez', NULL, NULL, 'Chillan/Camino San Antonio', 1, 'Chillan', NULL, 0, 0, 6, 2, '975995258'),
(8, '9.123.454-b', 'Alejandro', 'Alberto', 'Ramirez', 'rodrix@gmail.com', '748213', 'Santiago/Camino San Antonio', 4, 'Santiago', 8887, 0, 1, 6, 2, '975995258'),
(10, '9.142.654-h', 'Cardenas', 'Daniel', 'Luengo', 'telacress@gmail.com', '975995258', 'Chillan /Orfanato el pedregal', 2, 'Chillan', 1500, 0, 0, 0, 0, '62667624'),
(11, '9.142.654-h', 'Cardenas', 'Daniel', 'Luengo', 'telacress@gmail.com', '975995258', 'Chillan /Orfanato el pedregal', 2, 'Chillan', 1500, 0, 0, 0, 0, '62667624'),
(13, '70.058.220-5', 'Edgar', 'Alfonso', 'Cifuentes', 'pepenitro@gmail.com', '954132484', 'en algun lugar de chile', 3, 'santiago', 0, 1, 0, 0, 0, '643128421'),
(14, '77.947.444-K', 'Bartolome', 'alejandro', 'Cifuentes', NULL, NULL, 'donde estan los ka', 1, 'Santiago', NULL, 0, 2, 13, 6, '94823468'),
(15, '77.947.444-K', 'Bartolome', 'alejandro', 'Cifuentes', NULL, NULL, 'donde estan los ka', 1, 'Santiago', NULL, 0, 2, 13, 6, '94823468'),
(16, 'asdADAsdASD', 'asdASDasd', 'asdASDASd', 'asDASdASDasd', NULL, NULL, 'ASDsadASDadsAD', 1, 'ASdASDasd', NULL, 7, 0, 6, 6, 'ASDasdASD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_subject`
--

CREATE TABLE `user_subject` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_subject`
--

INSERT INTO `user_subject` (`id`, `user_id`, `subject_id`) VALUES
(1, 5, 3),
(2, 5, 2),
(3, 5, 4),
(4, 10, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `base_course`
--
ALTER TABLE `base_course`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `base_course_subject`
--
ALTER TABLE `base_course_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_course_id` (`base_course_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indices de la tabla `califications`
--
ALTER TABLE `califications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`teacher_id`,`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indices de la tabla `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indices de la tabla `history_course`
--
ALTER TABLE `history_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indices de la tabla `planilla`
--
ALTER TABLE `planilla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo` (`group_id`),
  ADD KEY `profesor` (`teacher_id`),
  ADD KEY `curso` (`base_course_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sige_asistance`
--
ALTER TABLE `sige_asistance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `representative_id` (`representative_id`,`representative_supp_id`),
  ADD KEY `course_id_2` (`course_id`);

--
-- Indices de la tabla `user_subject`
--
ALTER TABLE `user_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_` (`subject_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `base_course`
--
ALTER TABLE `base_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `base_course_subject`
--
ALTER TABLE `base_course_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `califications`
--
ALTER TABLE `califications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `history_course`
--
ALTER TABLE `history_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `planilla`
--
ALTER TABLE `planilla`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sige_asistance`
--
ALTER TABLE `sige_asistance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `user_subject`
--
ALTER TABLE `user_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `base_course_subject`
--
ALTER TABLE `base_course_subject`
  ADD CONSTRAINT `base_course_subject_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `base_course_subject_ibfk_2` FOREIGN KEY (`base_course_id`) REFERENCES `base_course` (`id`);

--
-- Filtros para la tabla `califications`
--
ALTER TABLE `califications`
  ADD CONSTRAINT `califications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `califications_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `califications_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Filtros para la tabla `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `group_user_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);

--
-- Filtros para la tabla `history_course`
--
ALTER TABLE `history_course`
  ADD CONSTRAINT `history_course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Filtros para la tabla `planilla`
--
ALTER TABLE `planilla`
  ADD CONSTRAINT `curso` FOREIGN KEY (`base_course_id`) REFERENCES `base_course` (`id`),
  ADD CONSTRAINT `grupo` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  ADD CONSTRAINT `profesor` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `sige_asistance`
--
ALTER TABLE `sige_asistance`
  ADD CONSTRAINT `sige_asistance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_subject`
--
ALTER TABLE `user_subject`
  ADD CONSTRAINT `user_subject_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);
