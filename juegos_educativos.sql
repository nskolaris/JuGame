-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2016 at 08:44 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `juegos_educativos`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatares`
--

CREATE TABLE IF NOT EXISTS `avatares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `avatares`
--

INSERT INTO `avatares` (`id`, `filename`) VALUES
(1, 'male-1.png'),
(2, 'female-1.png'),
(3, 'male-2.png'),
(4, 'female-2.png'),
(5, 'male-3.png'),
(6, 'female-3.png'),
(7, 'male-4.png'),
(8, 'female-4.png'),
(9, 'male-5.png'),
(10, 'female-5.png'),
(11, 'male-6.png'),
(12, 'female-6.png'),
(13, 'male-7.png'),
(14, 'female-7.png');

-- --------------------------------------------------------

--
-- Table structure for table `categorias_juegos`
--

CREATE TABLE IF NOT EXISTS `categorias_juegos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categorias_juegos`
--

INSERT INTO `categorias_juegos` (`id`, `nombre`) VALUES
(1, 'Geografía'),
(2, 'Historia'),
(3, 'Literatura');

-- --------------------------------------------------------

--
-- Table structure for table `ciclos_lectivos`
--

CREATE TABLE IF NOT EXISTS `ciclos_lectivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ciclos_lectivos`
--

INSERT INTO `ciclos_lectivos` (`id`, `ano`, `activo`) VALUES
(1, 2016, 1);

-- --------------------------------------------------------

--
-- Table structure for table `escuelas`
--

CREATE TABLE IF NOT EXISTS `escuelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `codigo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `escuelas`
--

INSERT INTO `escuelas` (`id`, `nombre`, `codigo`) VALUES
(1, 'Instituto Virgen del Valle', '453a3b2f151d6b08b0e530d2b093e128'),
(2, 'Test', '0cbc6611f5540bd0809a388dc95a615b');

-- --------------------------------------------------------

--
-- Table structure for table `grados`
--

CREATE TABLE IF NOT EXISTS `grados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `escuela_id` int(11) NOT NULL,
  `ciclo_lectivo_id` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `division` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `grados`
--

INSERT INTO `grados` (`id`, `escuela_id`, `ciclo_lectivo_id`, `ano`, `division`) VALUES
(1, 1, 1, 7, 'A'),
(2, 1, 1, 6, 'A'),
(3, 1, 1, 5, 'A'),
(4, 2, 1, 7, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `grados_usuarios`
--

CREATE TABLE IF NOT EXISTS `grados_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `grados_usuarios`
--

INSERT INTO `grados_usuarios` (`id`, `usuario_id`, `grado_id`) VALUES
(1, 22, 1),
(2, 23, 1),
(3, 24, 1),
(4, 25, 1),
(5, 26, 1),
(6, 27, 1),
(7, 28, 1),
(8, 29, 1),
(9, 30, 1),
(10, 31, 1),
(11, 32, 1),
(12, 33, 1),
(13, 34, 1),
(14, 35, 1),
(15, 36, 1),
(16, 37, 1),
(17, 38, 1),
(18, 39, 1),
(19, 40, 1),
(20, 44, 1),
(21, 21, 3),
(22, 46, 4),
(23, 47, 4),
(24, 48, 4),
(25, 49, 4),
(26, 50, 4),
(27, 51, 4),
(28, 52, 4),
(29, 53, 4),
(30, 55, 4),
(31, 54, 4),
(32, 56, 4),
(33, 57, 4),
(34, 58, 4);

-- --------------------------------------------------------

--
-- Table structure for table `juegos`
--

CREATE TABLE IF NOT EXISTS `juegos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `contenido` text,
  `categoria_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `contenido`, `categoria_id`, `created`, `modified`, `deleted`) VALUES
(1, 'Almirante Brown', NULL, 2, '2016-02-19 00:00:00', '2016-02-22 14:21:34', NULL),
(2, 'Sobre "Una nueva rebelión en la granja"', NULL, 3, '2016-02-19 00:00:00', '2016-02-22 15:33:22', NULL),
(3, 'La geografía, una ciencia social', NULL, 1, '2016-03-14 14:07:25', '2016-03-14 14:07:25', NULL),
(4, 'El laberinto del Minotauro', '<h1 style="text-align:center;">El Laberinto del Minotauro</h1>\r\n\r\n<p>Se cuenta que, en una ocasión, Pasifae, esposa del rey de Creta, Minos, incurrió en la ira de Poseidón, y este, como castigo, la condenó a dar a luz a un hijo deforme: el Minotauro, el cual tenía un enorme cuerpo de hombre y cabeza de toro. Para esconder al “monstruo”, Minos había mandado a construir por el famoso arquitecto Dédalo un laberinto; construcción tremendamente complicada de la que muy pocos conseguían salir, y escondiendo al pequeño en el lugar más apartado. A cada luna nueva, era imprescindible sacrificar un hombre, para que el Minotauro pudiera alimentarse, pues subsistía gracias a la carne humana. Sin embargo, y cuando este deseo no le era concedido, sembraba el terror y la muerte entre los distintos habitantes de la región.</p>\r\n\r\n<p>El rey Minos tenía otro hijo, Androgeo, quien estando en Atenas para participar en diversos juegos deportivos y al resultar ganador fue asesinado por los atenienses ya que le tenían celos tanto por su fuerza como habilidad. Minos, al enterarse de la trágica noticia, juró vengarse, reuniendo a su ejército y dirigiéndose luego a Atenas, la cual, al no estar preparada para semejante ataque sin previo aviso, tuvo pronto que capitular y negociar la paz. El rey cretense recibió a los embajadores atenienses, indicándoles que habían asesinado cruelmente a su hijo, e indicando posteriormente que, las condiciones para la paz, eran las siguientes: Atenas enviará cada nueve años siete jóvenes y siete doncellas a Creta, para que con su vida, pagaran la de su hijo fallecido. Los embajadores se sintieron presos por el terror cuando el rey añadió que los jóvenes serían ofrecidos al Minotauro, pero no les quedaba otra alternativa más que la de aceptar tan difícil condición.  Sólo tuvieron una única concesión: si uno de los jóvenes conseguía el triunfo, la ciudad se libraría del atroz atributo. Dos veces había pagado ya el terrible precio, pues dos veces una nave de origen ateniense e impulsada por velas había conducido, como se indicaba, a siete doncellas y siete jóvenes para que se dirigieran así a ese fatal destino que les esperaba. Sin embargo, la tercera vez que se realizó el sorteó de las víctimas que acudirían, Teseo, único hijo del rey de Atenas, Egeo, se ofreció voluntariamente a arriesgar su propia vida con tal de librar a la ciudad de aquel horrible futuro.</p>\r\n\r\n<p>Al día siguiente, él y sus compañeros se embarcaron y, el rey al despedir a su hijo, le comentó entre lágrimas y sollozos que pusieran velas blancas cuando regresase. De esta forma partieron, y pocos días después, llegaron a la isla de Creta. El temido y salvaje Minotauro, recluido en el laberinto, esperaba su comida hambriento. Los jóvenes y las doncellas debían permanecer custodiados en una vivienda hasta el día establecido para ingresar al laberinto, situada a las afueras de la ciudad. Esta prisión, en la cual los jóvenes eran tratados con la magnanimidad únicamente reservada a las víctimas de los sacrificios, estaba rodeada en sí por un parque que confinaba con el jardín en que las dos hijas de Minos solían pasearse (Fedra y Ariadna). La fama del valor y de la belleza de Teseo había llegado incluso a oídos de las dos preciosas doncellas, y, sobre todo Ariadna -la mayor de ellas- quien deseaba fervientemente conocer y ayudar al joven ateniense.</p>\r\n\r\n<p>Tras pasar algunas jornadas, Ariadna consiguió verlo un día paseando en el parque, lo llamó y le ofreció un ovillo de hilo, indicándole expresamente que representaba su salvación y la de sus compañeros. En cuanto entraran en el laberinto, debían atar el hilo a la entrada, y a medida que fueran penetrando en él tenían que ir desenrollándolo regularmente. De tal forma que, una vez muerto el Minotauro, pudieran enrollarlo y encontrar así el camino hacia la salida. Comentándole esto, se lo entregó a Teseo y le pidió que fuera un secreto ya  que si su padre se enteraba de aquello que estaba haciendo, entraría en una cólera y furia inmensas.  Ariadna le pidió que, en caso de que triunfara, la salvara y la llevara con ella.</p>\r\n\r\n<p>Al día siguiente, el joven ateniense fue conducido junto a sus demás compañeros al laberinto, y, cuando se halló lo suficiente dentro para no ser visto, ató el ovillo al muro y dejó que el hilo se fuera desenrollando poco a poco, mientras que, la salvaje bestia, mugía terriblemente presa de la inmensa hambre que tenía.</p>\r\n\r\n<p>Teseo, avanzaba sin temor alguno, y finalmente, al entrar en una caverna, se halló frente al terrible Minotauro. La bestia se abalanzó sobre el héroe quien hundió su puñal sobre el cuerpo del Minotauro. Con un espantoso bramido, y después de llevar a cabo unas cuantas puñaladas más, el monstruo lanzó un último gemido.</p>\r\n\r\n<p>A Teseo, por tanto, únicamente le quedaba enrollar de nuevo el hilo para recorrer el camino a seguir y poder salir del laberinto. A partir de ese momento, no sólo habría salvado incluso a sus compañeros, sino que incluso habría salvado a su propia ciudad. Cuando la nave estuvo lista para marcharse de Atenas, Teseo, a escondidas, condujo a bordo a Ariadna y también a su bella hermana.</p>\r\n\r\n<p>Durante el viaje la nave ancló en la isla de Nassos para refugiarse de una furiosa tempestad, y, cuando los vientos se calmaron, no pudieron encontrar a Ariadna; buscándola por todas partes… pero sin encontrarla: Se había quedado dormida en un bosque en el que, poco después, fue encontrada por el dios Dioniso, quien la hizo su esposa y la convirtió en inmortal.</p>', 3, '2016-04-14 20:02:17', '2016-04-25 16:04:58', NULL),
(5, '"Manos" de Elsa Bornemann', '<h1><i>Manos</i> de Elsa Bornemann</h1>\r\n<p>Montones de veces, y a mi pedido, mi inolvidable tío Tomás me contó esta historia “de miedo” cuando yo era chica y lo acompañaba a pescar ciertas noches de verano.</p>\r\n<p>Me aseguraba que había sucedido en un pueblo de la provincia de Buenos Aires. En Pergamino o Junín o Santa Lucía… No recuerdo con exactitud este dato ni la fecha cuando ocurrió tal acontecimiento y, lamentablemente, hace años que él ya no está para aclararme las dudas. Lo que sí recuerdo es que de entre todos los que el tío solía narrarme mientras sostenía la caña sobre el río y yo me echaba a su lado, cara a las estrellas, este relato era uno de mis preferidos.</p>\r\n<p>¡Te pone los pelos de punta y, sin embargo, encantada de escucharlo! ¿Quién entiende a esta sobrina? -me decía el tío. Ah, pero después no quiero quejas de tu mamá, ¿eh? Te lo cuento otra vez a cambio de tu promesa…</p>\r\n<p>Y entonces yo volvía a prometerle que guardaría el secreto, que mi madre no iba a enterarse de que él había vuelto a narrármelo, que iba a aguantarme sin llamarla si no podía dormir más tarde cuando, de regreso a casa, me fuera a la cama y a la soledad de mi cuarto. Siempre cumplí con mis promesas. Por eso, esta historia de manos, como tantas otras que sospecho eran inventadas por el tío o recordadas desde su propia infancia, me fue contada una y otra vez. Y una y otra vez la conté yo misma, años después,  a mis propios “sobrinos e hijos” así como ahora; me dispongo a contártela: como si, también fueras mi sobrina o mi sobrino, mi hija o mi hijo y me pidieras: -¡Dale, tía; dale, mami, un cuento “de miedo”! Y bien. Aquí va.</p>\r\n<p>Martina, Camila y Oriana eran amigas amiguísimas. No sólo concurrían a la misma escuela sino que  también, se encontraban fuera de los horarios de las clases. Unas veces, para preparar tareas escolares y otras, simplemente para estar juntas.</p>\r\n<p>De otoño a primavera, las tres solían pasar algunos fines de semana en la casa de campo que la familia de Martina tenía en las afueras de la ciudad. ¡Cómo se divertían entonces! Tantos juegos al aire libre, paseos en bicicleta, cabalgatas, fogones al anochecer…</p>\r\n<p>Aquel sábado de pleno invierno, por ejemplo, lo habían disfrutado por completo. Y la alegría de las tres nenas se prolongaba -aún- durante la cena en el comedor de la casa de campo porque la abuela Odila les reservaba una sorpresa: antes de ir a dormir les iba a enseñar unos pasos de zapateo americano, al compás de viejos discos que había traído especialmente para esa ocasión. Adorable la abuela de Martina. No aparentaba la edad que tenía. Siempre dinámica, coqueta, de buen humor, conversadora…\r\nHabía sido una excelente bailarina de “tap”. Las chicas lo sabían y por eso le habían insistido para que bailara con ellas.</p>\r\n<p>¿Por qué no lo dejan para mañana a la tardecita?, ¿eh? Ya es hora de ir a descansar. Además, la abuela no paró un minuto en todo el día. Debe de estar agotada.</p>\r\n<p>La mamá de Martina trató, en vano, de convencerlas para que se fueran a dormir A las cuatro y no sólo a las niñas, porque la abuela tampoco estaba dispuesta a concluir aquella jornada sin la anunciada sesión de baile. Así fue como, al rato y mientras los padres, los perros y la gata se ubicaban en la sala de estar a manera de público, la abuela y las tres nenas se preparaban para la función casera de zapateo americano. </p>\r\n<p>Afuera, el viento parecía querer sumarse con su propia melodía: silbaba con intensidad entre los árboles. Arriba, bien arriba, el cielo, con las estrellas escondidas tras espesos nubarrones.</p>\r\n<p>La improvisada clase de baile se prolongó cerca de una hora. El tiempo suficiente como para que Martina, Camila y Oriana aprendieran, entre risas, algunos pasos de “tap” y la abuela exhausta y muy acalorada.</p>\r\n<p>Pronto, todos se retiraron a sus cuartos. Alrededor de la casa, la noche, tan negra como el sombrero de copa que habían usado para la función. Las tres nenas ya se habían acostado. Ocupaban el cuarto de huéspedes, como en cada oportunidad que pasaban en esa casa. Era un dormitorio amplio, ubicado en el primer piso. Tenía ventanas que se abrían sobre el parque trasero del edificio y a través de las cuales solía filtrarse el resplandor de la luna (aunque no en noches como aquella, claro, en la que la oscuridad era un enorme poncho, cubriéndolo todo).</p>\r\n<p>En el cuarto había tres camas de una plaza, colocadas en forma paralela, en hilera y separadas por sólidas mesas de luz. En la cama de la izquierda, Martina, porque prefería el lugar junto a la puerta. En la cama de la derecha, Camila, porque le gustaba el sitio al lado de la ventana. En la cama del medio, Oriana, porque era miedosa y decía que así se sentía protegida por sus amigas.\r\nLas chicas acababan de dormirse cuando las despertó, de repente, la voz del padre. Terminaba de vestirse, nuevamente y de prisa, a la par que les decía: -La abuela se descompuso. Nada grave, creemos, pero vamos a llevarla hasta el hospital del pueblo para que la revisen, así nos quedamos tranquilos. Enseguida volvemos.</p>\r\n<p>Ah, dice mamá que no vayan a levantarse, que traten de dormir hasta que regresemos. Hasta luego.</p>\r\n<p>¿Dormir? ¿Quién podía dormir después de esa mala noticia? Las chicas no, al menos, preocupadas como se quedaban por la salud de la querida abuela. Y menos pudieron dormir minutos después de que oyeron el ruido del auto del padre, saliendo de la casa, ya que a la angustia de la espera se agregó el miedo por los tremendos ruidos de la tormenta que, finalmente, había decidido desmelenarse sobre la noche. Truenos y rayos que conmovían el corazón. Relámpagos, como gigantescas y electrizadas luciérnagas.\r\nEl viento, volcándose como pocas veces antes.</p>\r\n<p>¡Tengo miedo! ¡Tengo miedo! gritó Oriana, de repente. Las otras dos también lo tenían pero permanecían calladas, tragándose la inquietud. Martina trató de calmar a su amiguita (y de calmarse, por qué negarlo) encendiendo su velador. Camila hizo lo mismo.</p>\r\n<p>La cama de Oriana fue entonces la más iluminada de las tres ya que al estar en el medio de las otras recibía la luz directa dedos veladores. </p>\r\n<p>No pasa nada. La tormenta empeora la situación, eso es todo - decía Martina; dándose ánimo ella también con sus propios argumentos.</p>\r\n<p>Enseguida van a volver con la abuela. Seguro - . Opinaba Camila.</p>\r\n<p>Y así entre las lamentaciones de Oriana y las palabras de consuelo de las amigas más corajudas transcurrió alrededor de un cuarto de hora en todos los relojes. Cuando el de la sala grande y de péndulo marcó las doce con sus ahuecados talanes, las jovencitas ya habían logrado tranquilizarse bastante, a pesar de que la tormenta amenazaba con tornarse inacabable. Las luces se apagaron de golpe.</p>\r\n<p>-¡No me hagan bromas pesadas! -chilló Oriana-. ¡Enciendan los veladores otra vez, malditas! -y asustada, ella misma tanteó sobre las mesitas para encontrar las perillas. Sólo encontró las manos de sus amigas, haciendo lo propio.</p>\r\n<p>-¡Yo no apagué nada, boba! protestó Camila.</p>\r\n<p>-¡Se habrá cortado la luz! supuso Martina.</p>\r\n<p>Y así era nomás. Demasiada electricidad haciendo travesuras en el cielo y nada allí en la casa donde tanto se la necesitaba en esos momentos…</p>\r\n<p>Oriana se echó a llorar, desconsolada.</p>\r\n<p>-¡Tengo miedo! ¡Hay que ir a buscar las velas a la cocina! ¡Hay que bajara buscar fósforos y velas! ¡O una linterna!</p>\r\n<p>-“¡Hay que!” “¡Hay que!” ¡Qué viva la señorita! ¿Y quién baja? ¿Eh? ¿Quién? se enojó Camila. Yo, ¡ni loca!</p>\r\n<p>-¡Yo tampoco! agregó Martina. Esta Oriana se cree que soy la Superniña, pero no. Yo, también tengo miedo, ¡qué tanto! Además, mi mamá nos recomendó que no nos levantáramos, ¿recuerdan?\r\nOriana lloraba con la cabeza oculta debajo de la almohada.</p>\r\n<p>-Buaaaah… ¿Qué hacemos entonces? ¡Me muero de miedo! Por favor, bajen a buscar velas… Sean buenitas… Buaaah…</p>\r\n<p>Martina sintió pena por su amiga. Si bien eran de la misma edad, Oriana parecía más chiquita y se comportaba como tal. Se compadeció y actuó, entonces, cual si fuera una hermana mayor.</p>\r\n<p>– Bueno, bueno; no llores más, Ori. Tranquila… Se me ocurrió una idea. Vamos a hacer una cosa para no tener más miedo, ¿sí?</p>\r\n<p>– ¿Qué? -balbuceó Oriana.</p>\r\n<p>-¿Qué cosa? -Camila también se mostró interesada, lógico (aunque seguía sin quejarse, el temor la hacía temblar).</p>\r\n<p>Martina continuó con su explicación: -Nos tapamos bien -cada una en su cama- y estiramos los brazos, bien estirados hacia afuera, hasta darnos las manos.\r\nEnseguida, lo hicieron.</p>\r\n<p>Obviamente, Oriana fue la que se sintió más amparada: al estar en el medio de sus dos amigas y abrir los brazos en cruz, pudo sentir un apretoncito en ambas manos.</p>\r\n<p>-¡Qué suertuda Ori!, ¿eh? -bromeó Camila.</p>\r\n<p>-Desde tu cama se recibe compañía de los dos</p>\r\n<p>-En cambio, nosotras… -completó Martina- sólo con una mano…</p>\r\n<p>Y así -de manos fuertemente entrelazadas- las tres niñas lograron vencer buena parte de sus miedos. Al rato, todas dormían. Afuera, la tormenta empezaba a despedirse.</p>\r\n<p>-Gracias a Dios, la abuela ya se siente bien -les contó la madre al amanecer del día siguiente, en cuanto retornaron a la casa con su marido y su suegra y dispararon al primer piso para ver cómo estaban las chicas. Fue sólo un susto. Como, a su regreso, las niñas dormían plácidamente, la abuela misma había sido la encargada de despertarlas para avisarles que todo estaba en orden. </p>\r\n<p>-¡Qué alegría! Así me gusta. ¡Son muy valientes! Las felicito -y la abuela las besó y les prometió servirles el desayuno en la cama, para mimarlas un poco, después de la noche de nervios que habían pasado.</p>\r\n<p>-No tan valientes, señora… Al menos, yo no… -susurró Oriana, algo avergonzada por su comportamiento de la víspera-. Fue su nieta la que consiguió que nos calmáramos…</p>\r\n<p>Tras esta confesión de la nena, padres y abuela quisieron saber qué habían hecho para no asustarse demasiado.</p>\r\n<p>Entonces, las tres amiguitas les contaron:</p>\r\n<p>-Nos tapamos bien, cada una en su cama como ahora…</p>\r\n<p>-Estiramos los brazos así, como ahora…</p>\r\n<p>-Nos dimos las manos con fuerza, así, como ahora…</p>\r\n<p>¡Qué impresión les causó lo que comprobaron en ese instante, María Santísima! Y de la misma no se libraron ni los padres ni la abuela.</p>\r\n<p>Resulta que por más que se esforzaron -estirando los brazos a más no poder-sus manos infantiles no llegaban a rozarse siquiera.</p>\r\n<p>¡Y había que correr las camas laterales unos diez centímetros hacia la del medio para que las chicas pudieran tocarse -apenas- las puntas de los dedos!</p>\r\n<p>Sin embargo, las tres habían, realmente, sentido que sus manos les eran estrechadas por otras, no bien llevaron a la acción la propuesta de Martina.</p>\r\n<p>-¿Las manos de quién??? -exclamaron entonces mientras los adultos trataban de disimular sus propios sentimientos de horror.</p>\r\n<p>-¿¿¿De quiénes??? -corrigió Oriana con una mueca de espanto. ¡Ella había sido tomada de ambas manos!</p>\r\n<br>\r\n<p>Manos.</p>\r\n<p>Cuatro manos más aparte de las seis de las niñas, moviéndose en la oscuridad de aquella noche al encuentro de otras, en busca de aferrarse entre sí. Manos humanas. Manos espectrales. (Acaso -a veces, de tanto en tanto- los fantasmas también tengan miedo… y nos necesiten…)</p>\r\n<p>FIN</p>', 3, '2016-05-16 18:10:12', '2016-05-17 18:25:08', NULL),
(6, 'Los organismos genéticamente modificados', '<h1>Los organismos genéticamente modificados</h1>\r\n<p>Un OGM es un organismo animal o vegetal que ha sufrido un cambio en su información genética y, por lo tanto, en sus características. Por lo general, el cambio se debe a una manipulación de su material genético con el objetivo de dotarlo de propiedades que no son naturales para él.\r\nEn la actualidad, el conocimiento científico ha permitido transferir material genético entre especies diferentes. Cada día, en los medios de comunicación se informa acerca de casos de inserción de material hereditario de una especie animal a otra e, incluso, de material hereditario de un animal a una planta.</p>\r\n<p>Evidentemente, las posibilidades que ofrece la creación de OGM por parte de los científicos son muy importantes. Ya los agricultores y ganaderos utilizan plantas modificadas genéticamente que – entre otras características – pueden crecer más rápido, y producir frutos más grandes, y más nutritivos, y crían ganado que tiene más carne, produce más leche y hasta resiste a algunas enfermedades. Estos cambios no se detienen; incluso es posible que estos OGM produzcan, en sus hojas, en su carne o en su leche, medicamentos que se incorporan a través de los alimentos transgénicos. </p>\r\n<p>Hoy es difícil evaluar la cantidad de consecuencias que tendrá sobre el medio natural y el organismo humano la utilización de OGM. En el futuro, el impacto de estos organismos y sus derivados puede alterar las relaciones comerciales entre los países y despertar dilemas éticos y ambientales de los que no se tiene registro hasta la fecha. En la actualidad, por ejemplo, hay leyes en la Comunidad Económica Europea que prohíben la venta de productos derivados de OGM en sus países. Sin embargo, otros países, como los Estados Unidos, el Canadá y la Argentina, permiten que estos seres vivos y sus derivados sean utilizados para la alimentación de sus habitantes.</p>\r\n<p>Las industrias que crearon estos OGM también consideran que tienen derechos legales sobre sus creaciones y hasta pueden patentar seres vivos. Esta particular situación puede llevar a los agricultores a un callejón sin salida, porque podrían verse obligados a pagar derechos por usar OGM. Es decir, que la patente de estos descubrimientos podría llevar a la privatización de un patrimonio colectivo: los seres vivos y sus descendientes.</p>', 3, '2016-06-14 14:32:27', '2016-06-14 14:51:44', NULL),
(7, 'Juana Azurduy', '<p>Juana Azurduy de Padilla nació en Chuquisaca en 1780 y falleció en Jujuy hacia el año 1860. Fue la heroína de la independencia del Alto Perú (actual Bolivia). Descendiente de una familia mestiza, quedó huérfana en edad muy temprana. Pasó los primeros años de su vida en un convento de monjas de su provincia natal, Chuquisaca, la cual era entonces sede de la Real Audiencia de Charcas.</p>\r\n<p>En 1802 contrajo matrimonio con Manuel Ascencio Padilla, con quien tendría cinco hijos. Tras el estallido de la revolución independentista de Chuquisaca el 25 de mayo de 1809, Juana y su marido se unieron a los ejércitos populares, creados tras la destitución del virrey y al producirse el nombramiento de Juan Antonio Álvarez como gobernador del territorio. El caso de Juana no fue una excepción; muchas mujeres se incorporaban a la lucha en aquellos años.</p>\r\n<p>Juana colaboró activamente con su marido para organizar el escuadrón que sería conocido como Los Leales, el cual debía unirse a las tropas enviadas desde Buenos Aires para liberar el Alto Perú. Durante el primer año de lucha, Juana se vio obligada a abandonar a sus hijos y entró en combate en numerosas ocasiones, ya que la reacción realista desde Perú no se hizo esperar. La Audiencia de Charcas quedó dividida en dos zonas, una controlada por la guerrilla y otra por los ejércitos leales al rey de España.</p>\r\n<p>En 1810 se incorporó al ejército libertador de Manuel Belgrano, que quedó muy impresionado por el valor en combate de Juana; en reconocimiento a su labor, Belgrano llegó a entregarle su propia espada. Juana y su esposo participaron en la defensa de Tarabuco, La Laguna y Pomabamba.</p>\r\n<p>Mención especial merece la intervención de Juana Azurduy en la región de Villar, en el verano de 1816. Su marido tuvo que partir hacia la zona del Chaco y dejó a cargo de su esposa esa región estratégica, conocida también en la época como Hacienda de Villar. Dicha zona fue objeto de los ataques realistas, pero Juana organizó la defensa del territorio y, en una audaz incursión, arrebató ella misma la bandera del regimiento al jefe de las fuerzas enemigas y dirigió la ocupación del Cerro de la Plata. Por esta acción y con los informes favorables de Belgrano, el gobierno de Buenos Aires, en agosto de 1816, decidió otorgar a Juana Azurduy el rango de teniente coronel de las milicias, las cuales eran la base del ejército independentista de la región.</p>\r\n<p>Tras hacerse cargo el general José de San Martín de los ejércitos que pretendían liberar Perú, la estrategia de la guerra cambió. San Martín quería atacar Lima a través del Pacífico, por lo que era necesario, para poder desarrollar su estrategia, la liberación completa de Chile. Esta decisión dejó a la guerrilla del Alto Perú en condiciones muy precarias; Juana y su marido vivieron momentos extremadamente críticos, tanto que sus cuatro hijos mayores murieron de hambre.</p>\r\n<p>Poco tiempo después Juana, que esperaba a su quinto hijo, quedó viuda tras la muerte de su marido en la batalla de Villar (14 de septiembre de 1816). El cuerpo de su marido fue colgado por los realistas en el pueblo de la Laguna, y Juana se halló en una situación desesperada: sola, embarazada y con los ejércitos realistas controlando eficazmente el territorio. Tras dar a luz a una niña, se unió a la guerrilla de Martín Miguel de Güemes, que operaba en el norte del Alto Perú. A la muerte de este caudillo se disolvió la guerrilla del norte.</p>\r\n<p>Tras la proclamación de la independencia de Bolivia en 1825, Juana Azurduy intentó en numerosas ocasiones que el gobierno de la nueva nación le devolviera sus bienes para poder regresar a su ciudad natal, pero a pesar de su prestigio no consiguió una respuesta favorable de los dirigentes políticos. Murió en la provincia argentina de Jujuy a los ochenta años de edad, en la más completa miseria. Sólo póstumamente se le reconocerían el valor y los servicios prestados al país</p>', 2, '2016-07-06 12:45:36', '2016-07-06 12:48:02', NULL),
(9, 'Test XLS', 'Test XLS', 2, '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mp_juegos_preguntas`
--

CREATE TABLE IF NOT EXISTS `mp_juegos_preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `juego_id` int(11) NOT NULL,
  `mp_pregunta_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `mp_juegos_preguntas`
--

INSERT INTO `mp_juegos_preguntas` (`id`, `juego_id`, `mp_pregunta_id`, `created`, `modified`, `deleted`) VALUES
(47, 1, 1, NULL, NULL, NULL),
(48, 1, 2, NULL, NULL, NULL),
(49, 1, 3, NULL, NULL, NULL),
(50, 1, 4, NULL, NULL, NULL),
(51, 1, 5, NULL, NULL, NULL),
(52, 1, 6, NULL, NULL, NULL),
(53, 1, 7, NULL, NULL, NULL),
(54, 1, 8, NULL, NULL, NULL),
(55, 1, 9, NULL, NULL, NULL),
(56, 1, 10, NULL, NULL, NULL),
(57, 1, 11, NULL, NULL, NULL),
(58, 1, 12, NULL, NULL, NULL),
(59, 1, 13, NULL, NULL, NULL),
(60, 1, 27, NULL, NULL, NULL),
(61, 1, 28, NULL, NULL, NULL),
(62, 1, 29, NULL, NULL, NULL),
(63, 1, 30, NULL, NULL, NULL),
(64, 1, 31, NULL, NULL, NULL),
(65, 1, 32, NULL, NULL, NULL),
(66, 1, 33, NULL, NULL, NULL),
(67, 1, 34, NULL, NULL, NULL),
(68, 1, 35, NULL, NULL, NULL),
(94, 2, 14, NULL, NULL, NULL),
(95, 2, 15, NULL, NULL, NULL),
(96, 2, 16, NULL, NULL, NULL),
(97, 2, 17, NULL, NULL, NULL),
(98, 2, 18, NULL, NULL, NULL),
(99, 2, 19, NULL, NULL, NULL),
(100, 2, 20, NULL, NULL, NULL),
(101, 2, 21, NULL, NULL, NULL),
(102, 2, 22, NULL, NULL, NULL),
(103, 2, 23, NULL, NULL, NULL),
(104, 2, 24, NULL, NULL, NULL),
(105, 2, 25, NULL, NULL, NULL),
(106, 2, 26, NULL, NULL, NULL),
(107, 2, 36, NULL, NULL, NULL),
(108, 2, 37, NULL, NULL, NULL),
(109, 2, 38, NULL, NULL, NULL),
(110, 2, 39, NULL, NULL, NULL),
(111, 2, 40, NULL, NULL, NULL),
(112, 2, 41, NULL, NULL, NULL),
(113, 2, 42, NULL, NULL, NULL),
(114, 3, 43, NULL, NULL, NULL),
(115, 3, 44, NULL, NULL, NULL),
(116, 3, 45, NULL, NULL, NULL),
(117, 3, 46, NULL, NULL, NULL),
(118, 3, 47, NULL, NULL, NULL),
(119, 3, 48, NULL, NULL, NULL),
(120, 3, 49, NULL, NULL, NULL),
(121, 3, 50, NULL, NULL, NULL),
(122, 3, 51, NULL, NULL, NULL),
(123, 3, 52, NULL, NULL, NULL),
(124, 3, 53, NULL, NULL, NULL),
(125, 3, 54, NULL, NULL, NULL),
(126, 3, 55, NULL, NULL, NULL),
(157, 4, 60, NULL, NULL, NULL),
(158, 4, 61, NULL, NULL, NULL),
(159, 4, 62, NULL, NULL, NULL),
(160, 4, 63, NULL, NULL, NULL),
(161, 4, 64, NULL, NULL, NULL),
(162, 4, 65, NULL, NULL, NULL),
(163, 4, 66, NULL, NULL, NULL),
(164, 4, 67, NULL, NULL, NULL),
(165, 4, 68, NULL, NULL, NULL),
(166, 4, 69, NULL, NULL, NULL),
(188, 5, 74, NULL, NULL, NULL),
(189, 5, 75, NULL, NULL, NULL),
(190, 5, 76, NULL, NULL, NULL),
(191, 5, 77, NULL, NULL, NULL),
(192, 5, 78, NULL, NULL, NULL),
(193, 5, 79, NULL, NULL, NULL),
(194, 5, 80, NULL, NULL, NULL),
(195, 5, 81, NULL, NULL, NULL),
(196, 5, 82, NULL, NULL, NULL),
(197, 5, 83, NULL, NULL, NULL),
(206, 6, 84, NULL, NULL, NULL),
(207, 6, 85, NULL, NULL, NULL),
(208, 6, 86, NULL, NULL, NULL),
(209, 6, 87, NULL, NULL, NULL),
(210, 6, 88, NULL, NULL, NULL),
(211, 6, 89, NULL, NULL, NULL),
(212, 6, 90, NULL, NULL, NULL),
(213, 6, 91, NULL, NULL, NULL),
(220, 7, 92, NULL, NULL, NULL),
(221, 7, 93, NULL, NULL, NULL),
(222, 7, 94, NULL, NULL, NULL),
(223, 7, 95, NULL, NULL, NULL),
(224, 7, 96, NULL, NULL, NULL),
(225, 7, 97, NULL, NULL, NULL),
(226, 7, 98, NULL, NULL, NULL),
(227, 7, 99, NULL, NULL, NULL),
(229, 9, 106, NULL, NULL, NULL),
(230, 9, 107, NULL, NULL, NULL),
(231, 9, 108, NULL, NULL, NULL),
(232, 9, 109, NULL, NULL, NULL),
(233, 9, 110, NULL, NULL, NULL),
(234, 9, 111, NULL, NULL, NULL),
(235, 9, 112, NULL, NULL, NULL),
(236, 9, 113, NULL, NULL, NULL),
(237, 9, 114, NULL, NULL, NULL),
(238, 9, 115, NULL, NULL, NULL),
(239, 9, 116, NULL, NULL, NULL),
(240, 9, 117, NULL, NULL, NULL),
(241, 9, 118, NULL, NULL, NULL),
(242, 9, 119, NULL, NULL, NULL),
(243, 9, 120, NULL, NULL, NULL),
(244, 9, 121, NULL, NULL, NULL),
(245, 9, 122, NULL, NULL, NULL),
(246, 9, 123, NULL, NULL, NULL),
(247, 9, 124, NULL, NULL, NULL),
(248, 9, 125, NULL, NULL, NULL),
(249, 9, 126, NULL, NULL, NULL),
(250, 9, 127, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mp_partida_respuestas`
--

CREATE TABLE IF NOT EXISTS `mp_partida_respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pregunta_index` int(11) NOT NULL,
  `mp_pregunta_id` int(11) NOT NULL,
  `mp_pregunta_opcion_id` int(11) NOT NULL,
  `segundos_respuesta` int(11) DEFAULT '0',
  `puntos` int(11) DEFAULT '0',
  `puntos_normalizados` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_mp_partida_respuestas_usuario` (`partida_id`,`usuario_id`),
  KEY `i_mp_partida_respuestas_pregunta` (`partida_id`,`mp_pregunta_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203 ;

-- --------------------------------------------------------

--
-- Table structure for table `mp_preguntas`
--

CREATE TABLE IF NOT EXISTS `mp_preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_pregunta_tipo_id` int(11) NOT NULL,
  `texto` text NOT NULL,
  `comentario` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

--
-- Dumping data for table `mp_preguntas`
--

INSERT INTO `mp_preguntas` (`id`, `mp_pregunta_tipo_id`, `texto`, `comentario`, `created`, `modified`, `deleted`) VALUES
(1, 1, '¿Dónde nació el Almirante Brown?', 'El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(2, 1, '¿Cuándo nació el Almirante Brown?', 'El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(3, 1, '¿Cuándo falleció el Almirante Brown?', 'El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-02-19 00:00:00', NULL, NULL),
(4, 1, '¿Dónde falleció el Almirante Brown?', 'El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-02-19 00:00:00', NULL, NULL),
(5, 1, '¿Cómo aprendió a navegar?', 'Se embarcó como ayudante en un barco norteamericano', '2016-02-19 00:00:00', NULL, NULL),
(6, 1, '¿Qué cualidades lo destacaban?', 'La valentía y la astucia', '2016-02-19 00:00:00', NULL, NULL),
(7, 1, '¿Navegando para la marina de USA quién lo capturó?', 'Un buque inglés', '2016-02-19 00:00:00', NULL, NULL),
(8, 1, '¿Dónde estuvo prisionero?', 'En Francia', '2016-02-19 00:00:00', NULL, NULL),
(9, 1, '¿Cuántos años navegó en la armada de USA?', 'Diez años', '2016-02-19 00:00:00', NULL, NULL),
(10, 1, '¿Qué es una cualidad?', 'Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', '2016-02-19 00:00:00', NULL, NULL),
(11, 1, '¿Quiénes eran los realistas?', 'Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', '2016-02-19 00:00:00', NULL, NULL),
(12, 1, '¿Para qué vino Brown a América?', 'Para dedicarse al comercio', '2016-02-19 00:00:00', NULL, NULL),
(13, 1, '¿Cuál fue el puerto en el que<br>desmbarcó en su llegada a América?', 'Montevideo\r\n', '2016-02-19 00:00:00', NULL, NULL),
(14, 1, 'La historia se desarrolla en', 'La historia se desarrolla en Argentina.\r\n', '2016-02-19 00:00:00', NULL, NULL),
(15, 1, '¿Qué hacen los animales en la historia?', 'Los animales se rebelan.', '2016-02-19 00:00:00', NULL, NULL),
(16, 1, 'El primer caso que cuenta la historia fue protagonizado por', 'El primer caso que cuenta la historia fue protagonizado por las truchas.', '2016-02-19 00:00:00', NULL, NULL),
(17, 1, 'Finalmente, los animales terminan<br>contagiándose de los humanos de ', 'Finalmente, los animales terminan contagiándose de los humanos de su interés por el dinero.', '2016-02-19 00:00:00', NULL, NULL),
(18, 1, 'Según el relato, los animales comprenden ', 'Según el relato, los animales comprenden la lengua española.', '2016-02-19 00:00:00', NULL, NULL),
(19, 1, 'La historia es', 'La historia es ficción.', '2016-02-19 00:00:00', NULL, NULL),
(20, 1, 'El relato intenta tener un tono de', 'El relato intenta tener un tono de humor.', '2016-02-19 00:00:00', NULL, NULL),
(21, 1, 'El cuento está escrito en', 'El cuento está escrito en pasado.', '2016-02-19 00:00:00', NULL, NULL),
(22, 1, '¿Cuál de las siguientes marcas está mencionada?', 'La marca Lacoste es la que está mencionada.', '2016-02-19 00:00:00', NULL, NULL),
(23, 1, 'Quien "cuenta el cuento" es ', 'Quien "cuenta el cuento" es un ser humano.', '2016-02-19 00:00:00', NULL, NULL),
(24, 1, 'En el cuento se dice que las milanesas pueden ser', 'En el cuento se dice que las milanesas pueden ser a la yegua.', '2016-02-19 00:00:00', NULL, NULL),
(25, 1, '¿Quiénes pidieron que los seres humanos abriéramos la cabeza a<br>modelos más amplios en términos de belleza?', 'Loros y loras pidieron que los seres humanos abriéramos la cabeza a modelos más amplios en términos de belleza.', '2016-02-19 00:00:00', NULL, NULL),
(26, 1, '¿Qué significado se le da a "trucha", además del de pez?', 'Trucha quiere decir falsa, imitación', '2016-02-19 00:00:00', NULL, NULL),
(27, 1, '¿Cuál era el estado civil de Brown cuando vino a América?', 'Casado con una hija', NULL, NULL, NULL),
(28, 1, '¿Cuándo arribó a Buenos Aires?', 'El 18 de abril de 1810', NULL, NULL, NULL),
(29, 1, '¿Cuándo ocupó la isla Martín García?', 'El 15 de marzo de 1814', NULL, NULL, NULL),
(30, 1, '¿Cuándo tomó Montevideo?', 'Nunca, Montevideo la tomaron las fuerzas terrestes', NULL, NULL, NULL),
(31, 1, '¿Cuándo derrotó a la flota realista frente a Montevideo?', 'El 23 de junio de 1814', NULL, NULL, NULL),
(32, 1, '¿Qué es una fragata?', 'Un barco de madera, propulsado a velas', NULL, NULL, NULL),
(33, 1, '¿Cómo se llamaba la fragata<br>que utilizó en la campaña del Pacífico?', 'Hércules', NULL, NULL, NULL),
(34, 1, '¿Las costas de qué paises atacó<br>durante la campaña del Pacífico?', 'Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', NULL, NULL, NULL),
(35, 1, '¿Qué hizo cuando regresó a Buenos Aires?', 'Se retiró a su hogar y se dedicó al comercio', NULL, NULL, NULL),
(36, 1, '¿Qué quiere decir el prefijo "mono"?', 'El prefijo "mono" quiere decir uno', NULL, NULL, NULL),
(37, 1, '¿En qué centros de salud hubo numerosos pedidos de alta?', 'Hubo numerosos pedidos de alta en manicomios', NULL, NULL, NULL),
(38, 1, 'Según el texto, hay violencia en la expresión…', 'Según el texto, hay violencia en la expresión "es medio ganso".', NULL, NULL, NULL),
(39, 1, '¿En dónde fue el piquete que comienza la historia?', 'El piquete que comenzó la historia fue en un río de la Patagonia.', NULL, NULL, NULL),
(40, 1, 'Los animales deberían dejar de ser llamados', 'Los animales deberían dejar de ser llamdos animales', NULL, NULL, NULL),
(41, 1, '¿Quiénes hicieron paro de actividades en el circo?', 'Las monas hicieron paro de actividades en el circo.', NULL, NULL, NULL),
(42, 1, '¿Quiénes ponían condiciones para sacarse fotos<br>con los chicos en el zoológico?', 'Los burros ponían condiciones para sacarse fotos con los chicos en el zoológico.', NULL, NULL, NULL),
(43, 1, '¿De qué se ocupa la Geografía?', 'Estudia cómo viven las sociedades y organizan los territorios.\n', NULL, NULL, NULL),
(44, 1, '¿Cuáles son las herramientas de la geografía?', 'Representaciones gráficas, fotografías, estadísticas y regionalización.', NULL, NULL, NULL),
(45, 1, '¿Qué son los mapas?', 'Es una representación gráfica de la superficie terrestre.\n', NULL, NULL, NULL),
(46, 1, '¿Qué representa un planisferio?', 'Es una representación gráfica del total de  la superficie terrestre.', NULL, NULL, NULL),
(47, 1, '¿Qué muestran los planisferios políticos?', 'Muestran la organización territorial actual del mundo.', NULL, NULL, NULL),
(48, 1, '¿Qué son los paralelos?', 'Son círculos paralelos al Ecuador.', NULL, NULL, NULL),
(49, 1, '¿Qué son los meridianos?', 'Son semicírculos que van de polo a polo.', NULL, NULL, NULL),
(50, 1, '¿A qué se denomina escala?', 'Es la relación entre el tamaño real de la superficie terrestre y el dibujo que se realiza en en papel.', NULL, NULL, NULL),
(51, 1, '¿Qué representan los planos?', 'Son representaciones gráficas de pequeñas porciones de la superficie terestre.', NULL, NULL, NULL),
(52, 1, '¿Para qué se utilizan los cartogramas?', 'Son mapas que representan determinados fenómenos de una sociedad.', NULL, NULL, NULL),
(53, 1, '¿ Cómo se toman las fotografías aéreas?', 'A través de cámaras en aviones que vuelan a baja altura.', NULL, NULL, NULL),
(54, 1, '¿Qué podemos ver a través de las imágenes satelitales?', 'Podemos visualizar diferentes fenómenos como la distribución de algún recurso natural.', NULL, NULL, NULL),
(55, 1, '¿ Qué es la regionalización?', 'Es dividir el territorio en porciones más pequeñas.', NULL, NULL, NULL),
(60, 1, '¿Quién era el Minotauro?\r\n', ' El hijo deforme del rey Minos de Creta', NULL, NULL, NULL),
(61, 1, '¿Por qué Androgeo fue asesinado?', 'Por triunfar en las Olimpíadas', NULL, NULL, NULL),
(62, 1, 'En la frase “…Si uno de los jóvenes conseguía el triunfo,<br>la ciudad se libraría del atroz atributo”, ¿A qué triunfo hace referencia?', 'Matar al Minotauro', NULL, NULL, NULL),
(63, 1, 'Los Atenienses llegaron a Creta con<br>los jóvenes y las doncellas en…', 'Un Velero', NULL, NULL, NULL),
(64, 1, '¿Quién se ofreció voluntariamente a participar del<br>tercer grupo que concurrió al Laberinto de Creta?', 'Teseo', NULL, NULL, NULL),
(65, 1, '¿Por qué se lo reconocía a Teseo en Creta?', 'Por su valor y belleza', NULL, NULL, NULL),
(66, 1, '¿Qué objeto le entrega Ariadna a Teseo para ayudarlo?', 'Un hilo', NULL, NULL, NULL),
(67, 1, '¿Cómo logra Teseo acabar con el Minotauro?', 'Clavándole un arma', NULL, NULL, NULL),
(68, 1, '¿De qué manera sale Teseo del laberinto?', 'Por un túnel subterráneo', NULL, NULL, NULL),
(69, 1, '¿Qué sucedió con Ariadna al desembarcar<br>en la Isla de Nassos?', 'Se durmió en el bosque', NULL, NULL, NULL),
(74, 1, 'Esta historia es narrada inicialmente de…', 'Un tío a su sobrina', '2016-05-17 14:30:58', '2016-05-17 14:30:58', NULL),
(75, 1, 'El lugar aproximado dónde conoce el tío el relato es en…', 'En Buenos Aires', '2016-05-17 14:31:13', '2016-05-17 14:31:13', NULL),
(76, 1, 'Las protagonistas de la historia son…', 'Martina, Camila y Oriana', '2016-05-17 14:31:23', '2016-05-17 14:31:23', NULL),
(77, 1, 'La abuela de la protagonista era bailarina de…', 'Tap', '2016-05-17 14:31:29', '2016-05-17 14:31:29', NULL),
(78, 1, 'Las niñas dormían en el cuarto de huéspedes ubicado en el…', 'Primer Piso', '2016-05-17 14:31:36', '2016-05-17 14:31:36', NULL),
(79, 1, '¿Por qué los adultos se retiran de la casa en el medio de la noche?', 'Porque la abuela se descompuso', '2016-05-17 14:31:44', '2016-05-17 14:31:44', NULL),
(80, 1, 'Oriana se echó a llorar desconsoladamente porque…', 'Tenía miedo a la tormenta', '2016-05-17 14:31:52', '2016-05-17 14:31:52', NULL),
(81, 1, '¿Qué solución encontraron las niñas para calmar a su amiga?', 'Se taparon bien, estiraron los brazos y tomaron sus manos', '2016-05-17 14:32:00', '2016-05-17 14:32:00', NULL),
(82, 1, 'Cuando los adultos regresaron a la mañana siguiente, las niñas…', 'Dormían plácidamente', '2016-05-17 14:32:06', '2016-05-17 14:32:06', NULL),
(83, 1, '¿Qué sucedió al demostrar la forma en que habían<br>dormido la noche anterior?', 'Sus manos no se unían por más que lo intentaran', '2016-05-17 14:32:12', '2016-05-17 14:32:12', NULL),
(84, 1, 'Las siglas OGM quieren decir…', 'Organismo Genéticamente Modificado', '2016-06-14 14:33:59', '2016-06-14 14:33:59', NULL),
(85, 1, '¿Qué es un OGM?', 'Es un organismo animal o vegetal que ha sufrido un cambio en su información genética y características.', '2016-06-14 14:34:17', '2016-06-14 14:34:17', NULL),
(86, 1, '¿Por qué se produce el cambio genético?', 'Porque se lo quiere dotar de propiedades que no son naturales para él.', '2016-06-14 14:34:24', '2016-06-14 14:34:24', NULL),
(87, 1, 'Todos los días, en los medios de comunicación se informa…', 'Sobre los casos de inserción de material hereditario', '2016-06-14 14:34:30', '2016-06-14 14:34:30', NULL),
(88, 1, '¿Qué utilizan los agricultores y ganaderos en la actualidad?', ' Plantas modificadas genéticamente que pueden crecer más rápido, y producir frutos más grandes, y más nutritivos.', '2016-06-14 14:34:38', '2016-06-14 14:34:38', NULL),
(89, 1, '¿Cuáles son las consecuencias por el uso de OGM?', 'Aún no se saben.\n', '2016-06-14 14:34:45', '2016-06-14 14:34:45', NULL),
(90, 1, 'La venta de productos derivados de OGM…', 'Está prohibida en la Unión Europea.\n', '2016-06-14 14:34:51', '2016-06-14 14:34:51', NULL),
(91, 1, '¿Qué patrimonio colectivo podría privatizarse?', 'Los seres vivos y sus descendientes.', '2016-06-14 14:34:58', '2016-06-14 14:34:58', NULL),
(92, 1, 'Juana Azurduy fue la heroína de…', NULL, '2016-07-06 12:46:06', '2016-07-06 12:46:06', NULL),
(93, 1, '¿Cómo pasó sus primeros años de vida?', NULL, '2016-07-06 12:46:47', '2016-07-06 12:46:47', NULL),
(94, 1, 'Se casó con Manuel Ascencio Padilla y tuvo…', NULL, '2016-07-06 12:47:08', '2016-07-06 12:47:08', NULL),
(95, 1, 'En aquellos años…', NULL, '2016-07-06 12:47:15', '2016-07-06 12:47:15', NULL),
(96, 1, 'Juana y su marido organizaron el escuadrón llamado…', NULL, '2016-07-06 12:47:23', '2016-07-06 12:47:23', NULL),
(97, 1, 'Manuel Belgrano en reconocimiento a su valor…', NULL, '2016-07-06 12:47:29', '2016-07-06 12:47:29', NULL),
(98, 1, 'En la región conocida como Hacienda de Villar, Juana organizó la defensa del territorio y, en una audaz incursión…', NULL, '2016-07-06 12:47:37', '2016-07-06 12:47:37', NULL),
(99, 1, 'Falleció a los 80 años de edad…', NULL, '2016-07-06 12:47:44', '2016-07-06 12:47:44', NULL),
(106, 1, '¿Dónde nació el Almirante Brown?', 'El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(107, 1, '¿Cuándo nació el Almirante Brown?', 'El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(108, 1, '¿Cuándo falleció el Almirante Brown?', 'El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(109, 1, '¿Dónde falleció el Almirante Brown?', 'El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(110, 1, '¿Cómo aprendió a navegar?', 'Se embarcó como ayudante en un barco norteamericano', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(111, 1, '¿Qué cualidades lo destacaban?', 'La valentía y la astucia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(112, 1, '¿Navegando para la marina de USA quién lo capturó?', 'Un buque inglés', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(113, 1, '¿Dónde estuvo prisionero?', 'En Francia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(114, 1, '¿Cuántos años navegó en la armada de USA?', 'Diez años', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(115, 1, '¿Qué es una cualidad?', 'Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(116, 1, '¿Quiénes eran los realistas?', 'Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(117, 1, '¿Para qué vino Brown a América?', 'Para dedicarse al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(118, 1, '¿Cuál fue el puerto en el que desmbarcó en su llegada a América?', 'Montevideo', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(119, 1, '¿Cuál era el estado civil de Brown cuando vino a América?', 'Casado con una hija', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(120, 1, '¿Cuándo arribó a Buenos Aires?', 'El 18 de abril de 1810 ', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(121, 1, '¿Cuándo ocupó la isla Martín García?', 'El 15 de marzo de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(122, 1, '¿Cuándo tomó Montevideo?', 'Nunca, Montevideo la tomaron las fuerzas terrestes', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(123, 1, '¿Cuándo derrotó a la flota realista frente a Montevideo?', 'El 23 de junio de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(124, 1, '¿Qué es una fragata?', 'Un barco de madera, propulsado a velas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(125, 1, '¿Cómo se llamaba la fragata que utilizó en la campaña del Pacífico?', 'Hércules', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(126, 1, '¿Las costas de qué paises atacó durante la campaña del Pacífico?', 'Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(127, 1, '¿Qué hizo cuando regresó a Buenos Aires?', 'Se retiró a su hogar y se dedicó al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mp_pregunta_opciones`
--

CREATE TABLE IF NOT EXISTS `mp_pregunta_opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_pregunta_id` int(11) NOT NULL,
  `texto` text NOT NULL,
  `es_correcta` int(1) DEFAULT '0',
  `puntos` int(11) DEFAULT '0',
  `comentario` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_mp_pregunta_opciones_pregunta` (`mp_pregunta_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=571 ;

--
-- Dumping data for table `mp_pregunta_opciones`
--

INSERT INTO `mp_pregunta_opciones` (`id`, `mp_pregunta_id`, `texto`, `es_correcta`, `puntos`, `comentario`, `created`, `modified`, `deleted`) VALUES
(1, 1, 'Irlanda', 1, 10, '¡Bien hecho! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(2, 1, 'Inglaterra', 0, -3, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(3, 1, 'Francia', 0, -7, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(4, 1, 'Argentina', 0, -10, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(6, 2, '22 de junio de 1777', 1, 10, '¡Bien hecho! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(7, 2, '26 de febrero de 1778', 0, -3, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(8, 2, '22 de junio de 1815', 0, -7, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(9, 2, '9 de julio de 1816', 0, -10, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-02-19 00:00:00', NULL, NULL),
(10, 5, 'Se embarcó como ayudante en un barco norteamericano', 1, 10, '¡Bien hecho! Se embarcó como ayudante en un barco norteamericano\r\n', '2016-02-19 00:00:00', NULL, NULL),
(11, 5, 'Se embarcó como ayudante en un barco inglés', 0, -3, '¡Error! Se embarcó como ayudante en un barco norteamericano', '2016-02-19 00:00:00', NULL, NULL),
(12, 5, 'Estudio en la Armada Inglesa', 0, -7, '¡Error! Se embarcó como ayudante en un barco norteamericano', '2016-02-19 00:00:00', NULL, NULL),
(13, 5, 'Nunca supo navegar', 0, -10, '¡Error! Se embarcó como ayudante en un barco norteamericano', '2016-02-19 00:00:00', NULL, NULL),
(14, 3, '3 de marzo de 1857', 1, 10, '¡Bien hecho! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(15, 3, '17 de agosto de 1850', 0, -3, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(16, 3, '9 de enero de 1870', 0, -7, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(17, 3, '7 de septiembre de 1920', 0, -10, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(18, 4, 'Buenos Aires', 1, 10, '¡Bien hecho! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(19, 4, 'Montevideo', 0, -3, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(20, 4, 'Londres', 0, -7, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(21, 4, 'Boulong sur Mer', 0, -10, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', NULL, NULL, NULL),
(22, 6, 'La valentía y la astucia', 1, 10, '¡Bien hecho! La valentía y la astucia', NULL, NULL, NULL),
(23, 6, 'La honradez y la lealtad', 0, -3, '¡Error! La valentía y la astucia', NULL, NULL, NULL),
(24, 6, 'La puntualidad y la inteligencia', 0, -7, '¡Error! La valentía y la astucia', NULL, NULL, NULL),
(25, 6, 'La devoción y la frugalidad', 0, -10, '¡Error! La valentía y la astucia', NULL, NULL, NULL),
(26, 7, 'Un buque inglés', 1, 10, '¡Bien hecho!Un buque inglés', NULL, NULL, NULL),
(27, 7, 'La armada francesa', 0, -3, '¡Error! Un buque inglés', NULL, NULL, NULL),
(28, 7, 'Los piratas del Caribe', 0, -7, '¡Error! Un buque inglés', NULL, NULL, NULL),
(29, 7, 'Piratas turcos', 0, -10, '¡Error! Un buque inglés', NULL, NULL, NULL),
(30, 8, 'En Francia', 1, 10, '¡Bien hecho! En Francia', NULL, NULL, NULL),
(31, 8, 'En Inglaterra', 0, -3, '¡Error! En Francia', NULL, NULL, NULL),
(32, 8, 'En Buenos Aires', 0, -7, '¡Error! En Francia', NULL, NULL, NULL),
(34, 9, 'Diez años', 1, 10, '¡Bien hecho! Diez años', NULL, NULL, NULL),
(35, 9, 'Doce años', 0, -3, '¡Error! Diez años', NULL, NULL, NULL),
(36, 9, 'Quince años', 0, -7, '¡Error! Diez años', NULL, NULL, NULL),
(37, 9, 'Veinte años', 0, -10, '¡Error! Diez años', NULL, NULL, NULL),
(38, 10, 'Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', 1, 10, '¡Bien hecho! Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', NULL, NULL, NULL),
(39, 10, 'Algo bueno', 0, -3, '¡Error! Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', NULL, NULL, NULL),
(40, 10, 'Ser estudioso', 0, -7, '¡Error! Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', NULL, NULL, NULL),
(41, 10, 'Un hecho casual', 0, -10, '¡Error! Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', NULL, NULL, NULL),
(42, 11, 'Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', 1, 10, '¡Bien hecho! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', NULL, NULL, NULL),
(43, 11, 'Los que querían instalar una monarquía en América', 0, -3, '¡Error! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', NULL, NULL, NULL),
(44, 11, 'Los que querían imponer el real como moneda corriente en América', 0, -7, '¡Error! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', NULL, NULL, NULL),
(45, 11, 'Una corriente filosóica que sostiene "la unica verdad es la realidad"', 0, -10, '¡Error! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', NULL, NULL, NULL),
(46, 12, 'Para dedicarse al comercio', 1, 10, '¡Bien hecho! Para dedicarse al comercio', NULL, NULL, NULL),
(47, 12, 'A liberar las colonias de América', 0, -3, '¡Error! Para dedicarse al comercio', NULL, NULL, NULL),
(48, 12, 'Para catequizar a los indigenas nativos', 0, -7, '¡Error! Para dedicarse al comercio', NULL, NULL, NULL),
(49, 12, 'Para hacer turismo', 0, -10, '¡Error! Para dedicarse al comercio', NULL, NULL, NULL),
(50, 13, 'Montevideo', 1, 10, '¡Bien hecho! Montevideo', NULL, NULL, NULL),
(51, 13, 'Buenos Aires', 0, -3, '¡Error! Montevideo', NULL, NULL, NULL),
(52, 13, 'Río de Janeiro', 0, -7, '¡Error! Montevideo', NULL, NULL, NULL),
(53, 13, 'Boulong sur Mer', 0, -10, '¡Error! Montevideo', NULL, NULL, NULL),
(54, 14, 'Argentina', 1, 10, '¡Bien hecho!La historia se desarrolla en Argentina.', NULL, NULL, NULL),
(55, 14, 'un país latinoamericano, que no es Argentina', 0, -3, '¡Error! La historia se desarrolla en Argentina.', NULL, NULL, NULL),
(56, 14, 'un país europeo de habla hispana', 0, -7, '¡Error! La historia se desarrolla en Argentina.', NULL, NULL, NULL),
(57, 14, 'Alemania', 0, -10, '¡Error! La historia se desarrolla en Argentina.', NULL, NULL, NULL),
(58, 15, 'se rebelan', 1, 10, '¡Bien hecho! Los animales se rebelan.', NULL, NULL, NULL),
(59, 15, 'se revelan', 0, -3, '¡Error! Los animales se rebelan.', NULL, NULL, NULL),
(60, 15, 'se complotan contra los humanos', 0, -7, '¡Error! Los animales se rebelan.', NULL, NULL, NULL),
(61, 15, 'se van del lugar donde se desarrolla la historia', 0, -10, '¡Error! Los animales se rebelan.', NULL, NULL, NULL),
(62, 16, 'las truchas', 1, 10, '¡Bien hecho! El primer caso que cuenta la historia fue protegonizado por las truchas.', NULL, NULL, NULL),
(63, 16, 'las monas', 0, -3, '¡Error! El primer caso que cuenta la historia fue protagonizado por las truchas.', NULL, NULL, NULL),
(64, 16, 'las loras', 0, -7, '¡Error! El primer caso que cuenta la historia fue protagonizado por las truchas.', NULL, NULL, NULL),
(65, 16, 'los perros', 0, -10, '¡Error! El primer caso que cuenta la historia fue protagonizado por las truchas.', NULL, NULL, NULL),
(66, 17, 'su interés por el dinero', 1, 10, '¡Bien hecho! Finalmente, los animales terminan contagiándose de los humanos de su interés por el dinero.', NULL, NULL, NULL),
(67, 17, 'su interés por el lenguaje', 0, -3, '¡Error! Finalmente, los animales terminan contagiándose de los humanos de su interés por el dinero.', NULL, NULL, NULL),
(68, 17, 'su interés por los animales', 0, -7, '¡Error! Finalmente, los animales terminan contagiándose de los humanos de su interés por el dinero.', NULL, NULL, NULL),
(69, 17, 'su amor por la naturaleza', 0, -10, '¡Error! Finalmente, los animales terminan contagiándose de los humanos de su interés por el dinero.', NULL, NULL, NULL),
(70, 18, 'la lengua española', 1, 10, '¡Bien hecho! Según el relato, los animales comprenden la lengua española.', NULL, NULL, NULL),
(71, 18, 'el lenguaje en cualquier idioma', 0, -3, '¡Error! Según el relato, los animales comprenden la lengua española.', NULL, NULL, NULL),
(72, 18, 'la matemática', 0, -7, '¡Error! Según el relato, los animales comprenden la lengua española.', NULL, NULL, NULL),
(73, 18, 'la imposibilidad de comunicarse ', 0, -10, '¡Error! Según el relato, los animales comprenden la lengua española.', NULL, NULL, NULL),
(74, 19, 'ficción', 1, 10, '¡Bien hecho! La historia es ficción.', NULL, NULL, NULL),
(75, 19, 'parte ficción y parte real', 0, -3, '¡Error! La historia es ficción.', NULL, NULL, NULL),
(76, 19, 'totalmente real', 0, -7, '¡Error! La historia es ficción.', NULL, NULL, NULL),
(77, 19, 'parte de la Biblia', 0, -10, '¡Error! La historia es ficción.', NULL, NULL, NULL),
(78, 20, 'humor', 1, 10, '¡Bien hecho! El relato intenta tener un tono de humor.', NULL, NULL, NULL),
(79, 20, 'novela', 0, -3, '¡Error! El relato intenta tener un tono de humor.', NULL, NULL, NULL),
(80, 20, 'suspenso', 0, -7, '¡Error! El relato intenta tener un tono de humor.', NULL, NULL, NULL),
(81, 20, 'terror', 0, -10, '¡Error! El relato intenta tener un tono de humor.', NULL, NULL, NULL),
(82, 21, 'pasado', 1, 10, '¡Bien hecho! El cuento está escrito en pasado.', NULL, NULL, NULL),
(83, 21, 'presente', 0, -3, '¡Error! El cuento está escrito en pasado.', NULL, NULL, NULL),
(84, 21, 'parte presente y parte futuro', 0, -7, '¡Error! El cuento está escrito en pasado.', NULL, NULL, NULL),
(85, 21, 'futuro', 0, -10, '¡Error! El cuento está escrito en pasado.', NULL, NULL, NULL),
(86, 22, 'Lacoste', 1, 10, '¡Bien hecho! La marca Lacoste es la que está mencionada.', NULL, NULL, NULL),
(87, 22, 'Puma', 0, -3, '¡Error! La marca Lacoste es la que está mencionada.', NULL, NULL, NULL),
(88, 22, 'Peugeot', 0, -7, '¡Error! La marca Lacoste es la que está mencionada.', NULL, NULL, NULL),
(89, 22, 'Ford', 0, -10, '¡Error! La marca Lacoste es la que está mencionada.', NULL, NULL, NULL),
(90, 23, 'un ser humano', 1, 10, '¡Bien hecho! Quien "cuenta el cuento" es un ser humano.', NULL, NULL, NULL),
(91, 23, 'una mujer', 0, -3, '¡Error! Quien "cuenta el cuento" es un ser humano.', NULL, NULL, NULL),
(92, 23, 'una trucha ', 0, -7, '¡Error! Quien "cuenta el cuento" es un ser humano.', NULL, NULL, NULL),
(93, 23, 'un animal no identificado', 0, -10, '¡Error! Quien "cuenta el cuento" es un ser humano.', NULL, NULL, NULL),
(94, 24, 'a la yegua', 1, 10, '¡Bien hecho! En el cuento se dice que las milanesas pueden ser a la yegua.', NULL, NULL, NULL),
(95, 24, 'a caballo ', 0, -3, '¡Error! En el cuento se dice que las milanesas pueden ser a la yegua.', NULL, NULL, NULL),
(96, 24, 'con dos huevos fritos encima', 0, -7, '¡Error! En el cuento se dice que las milanesas pueden ser a la yegua.', NULL, NULL, NULL),
(97, 24, 'de soja', 0, -10, '¡Error! En el cuento se dice que las milanesas pueden ser a la yegua.', NULL, NULL, NULL),
(98, 25, 'loros y loras', 1, 10, '¡Bien hecho! Loros y loras pidieron que los seres humanos abriéramos la cabeza a modelos más amplios en términos de belleza.', NULL, NULL, NULL),
(99, 25, 'las loras', 0, -3, '¡Error! Loros y loras pidieron que los seres humanos abriéramos la cabeza a modelos más amplios en términos de belleza.', NULL, NULL, NULL),
(100, 25, 'los cocodrilos', 0, -7, '¡Error! Loros y loras pidieron que los seres humanos abriéramos la cabeza a modelos más amplios en términos de belleza.', NULL, NULL, NULL),
(101, 25, 'los tigres', 0, -10, '¡Error! Loros y loras pidieron que los seres humanos abriéramos la cabeza a modelos más amplios en términos de belleza.', NULL, NULL, NULL),
(102, 26, 'falsa, imitación', 1, 10, '¡Bien hecho! Trucha quiere decir falsa, imitación', NULL, NULL, NULL),
(103, 26, 'barata, de bajo costo', 0, -3, '¡Error! Trucha quiere decir falsa, imitación', NULL, NULL, NULL),
(104, 26, 'cara, de alto costo', 0, -7, '¡Error! Trucha quiere decir falsa, imitación', NULL, NULL, NULL),
(105, 26, 'verdadera, auténtica', 0, -10, '¡Error! Trucha quiere decir falsa, imitación', NULL, NULL, NULL),
(106, 27, 'Casado con una hija', 1, 10, '¡Bien hecho! Casado con una hija', NULL, NULL, NULL),
(107, 27, 'Soltero', 0, -3, '¡Error! Casado con una hija', NULL, NULL, NULL),
(108, 27, 'Viudo', 0, -7, '¡Error! Casado con una hija', NULL, NULL, NULL),
(110, 28, 'El 18 de abril de 1810', 1, 10, '¡Bien hecho! El 18 de abril de 1810', NULL, NULL, NULL),
(111, 28, 'El 25 de mayo de 1810', 0, -3, '¡Error! El 18 de abril de 1810', NULL, NULL, NULL),
(112, 28, 'El 9 de julio de 1816', 0, -7, '¡Error! El 18 de abril de 1810', NULL, NULL, NULL),
(113, 28, 'El 30 de agosto de 1843', 0, -10, '¡Error! El 18 de abril de 1810', NULL, NULL, NULL),
(114, 29, 'El 15 de marzo de 1814', 1, 10, '¡Bien hecho! El 15 de marzo de 1814', NULL, NULL, NULL),
(115, 29, 'El 18 de abril de 1810 ', 0, -3, '¡Error! El 15 de marzo de 1814', NULL, NULL, NULL),
(116, 29, 'El 9 de julio de 1816', 0, -7, '¡Error! El 15 de marzo de 1814', NULL, NULL, NULL),
(117, 29, 'El 3 de junio de 1852', 0, -10, '¡Error! El 15 de marzo de 1814', NULL, NULL, NULL),
(118, 30, 'Nunca, Montevideo la tomaron las fuerzas terrestes', 1, 10, '¡Bien hecho! Nunca, Montevideo la tomaron las fuerzas terrestes', NULL, NULL, NULL),
(119, 30, 'El 23 de junio de 1814', 0, -3, '¡Error! Nunca, Montevideo la tomaron las fuerzas terrestes', NULL, NULL, NULL),
(120, 30, 'El 9 de julio de 1816', 0, -7, '¡Error! Nunca, Montevideo la tomaron las fuerzas terrestes', NULL, NULL, NULL),
(121, 30, 'El 22 de abril de 1845', 0, -10, '¡Error! Nunca, Montevideo la tomaron las fuerzas terrestes', NULL, NULL, NULL),
(122, 31, 'El 23 de junio de 1814', 1, 10, '¡Bien hecho! El 23 de junio de 1814', NULL, NULL, NULL),
(123, 31, 'El 14 de agosto de 1817', 0, -3, '¡Error! El 23 de junio de 1814', NULL, NULL, NULL),
(124, 31, 'El 20 de diciembre de 1830', 0, -7, '¡Error! El 23 de junio de 1814', NULL, NULL, NULL),
(125, 31, 'El 15 de octubre de 1845', 0, -10, '¡Error! El 23 de junio de 1814', NULL, NULL, NULL),
(126, 32, 'Un barco de madera, propulsado a velas', 1, 10, '¡Bien hecho! Un barco de madera, propulsado a velas', NULL, NULL, NULL),
(127, 32, 'Un bote de remos, muy veloz', 0, -3, '¡Error! Un barco de madera, propulsado a velas', NULL, NULL, NULL),
(128, 32, 'Una balsa', 0, -7, '¡Error! Un barco de madera, propulsado a velas', NULL, NULL, NULL),
(130, 33, 'Hércules', 1, 10, '¡Bien hecho! Hércules', NULL, NULL, NULL),
(131, 33, 'Sansón', 0, -3, '¡Error! Hércules', NULL, NULL, NULL),
(132, 33, 'Libertad', 0, -7, '¡Error! Hércules', NULL, NULL, NULL),
(133, 33, 'HSM Warrior', 0, -10, '¡Error! Hércules', NULL, NULL, NULL),
(134, 34, 'Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', 1, 10, '¡Bien hecho! Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', NULL, NULL, NULL),
(135, 34, 'Atacó a los realistas en las costas de Chile, Perú, Bolivia y Venezuela', 0, -3, '¡Error! Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', NULL, NULL, NULL),
(136, 34, 'Atacó a los realistas en las costas de Perú, Colombia  Venezuela', 0, -7, '¡Error! Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', NULL, NULL, NULL),
(138, 35, 'Se retiró a su hogar y se dedicó al comercio', 1, 10, '¡Bien hecho! Se retiró a su hogar y se dedicó al comercio', NULL, NULL, NULL),
(139, 35, 'Se retiró a su hogar', 0, -3, '¡Error! Se retiró a su hogar y se dedicó al comercio', NULL, NULL, NULL),
(140, 35, 'Participó en el conflicto entre unitarios y federales', 0, -7, '¡Error! Se retiró a su hogar y se dedicó al comercio', NULL, NULL, NULL),
(141, 35, 'Se embarcó de regreso a Irlanda', 0, -10, '¡Error! Se retiró a su hogar y se dedicó al comercio', NULL, NULL, NULL),
(142, 36, 'uno', 1, 10, '¡Bien hecho! El prefijo "mono" quiere decir uno', NULL, NULL, NULL),
(143, 36, 'único', 0, -3, '¡Error! El prefijo "mono" quiere decir uno', NULL, NULL, NULL),
(144, 36, 'lindo, agradable', 0, -7, '¡Error! El prefijo "mono" quiere decir uno', NULL, NULL, NULL),
(145, 36, 'animal', 0, -10, '¡Error! El prefijo "mono" quiere decir uno', NULL, NULL, NULL),
(146, 37, 'en los manicomios', 1, 10, '¡Bien hecho! Hubo numerosos pedidos de alta en manicomios', NULL, NULL, NULL),
(147, 37, 'en las clínicas cardiológicas (problemas del corazón)', 0, -3, '¡Error! Hubo numerosos pedidos de alta en manicomios', NULL, NULL, NULL),
(148, 37, 'en las veterinarias', 0, -7, '¡Error! Hubo numerosos pedidos de alta en manicomios', NULL, NULL, NULL),
(149, 37, 'en Casa de Gobierno', 0, -10, '¡Error! Hubo numerosos pedidos de alta en manicomios', NULL, NULL, NULL),
(150, 38, 'es medio ganso', 1, 10, '¡Bien hecho! Según el texto, hay violencia en la expresión "es medio ganso".', NULL, NULL, NULL),
(151, 38, 'sos un perro', 0, -3, '¡Error! Según el texto, hay violencia en la expresión "es medio ganso".', NULL, NULL, NULL),
(152, 38, 'más vale pájaro en mano que cien volando', 0, -7, '¡Error! Según el texto, hay violencia en la expresión "es medio ganso".', NULL, NULL, NULL),
(153, 38, 'no por mucho madrugar amanece más temprano', 0, -10, '¡Error! Según el texto, hay violencia en la expresión "es medio ganso".', NULL, NULL, NULL),
(154, 39, 'un río de la Patagonia', 1, 10, '¡Bien hecho! El piquete que comenzó la historia fue en un río de la Patagonia.', NULL, NULL, NULL),
(155, 39, 'un río del norte argentino', 0, -3, '¡Error! El piquete que comenzó la historia fue en un río de la Patagonia.', NULL, NULL, NULL),
(156, 39, 'en la Ciudad de Buenos Aires', 0, -7, '¡Error! El piquete que comenzó la historia fue en un río de la Patagonia.', NULL, NULL, NULL),
(157, 39, 'en París', 0, -10, '¡Error! El piquete que comenzó la historia fue en un río de la Patagonia.', NULL, NULL, NULL),
(158, 40, 'animales', 1, 10, '¡Bien hecho! Los animales deberían dejar de ser llamdos animales', NULL, NULL, NULL),
(159, 40, 'mascotas', 0, -3, '¡Error! Los animales deberían dejar de ser llamdos animales', NULL, NULL, NULL),
(160, 40, 'seres', 0, -7, '¡Error! Los animales deberían dejar de ser llamdos animales', NULL, NULL, NULL),
(161, 40, 'seres racionales', 0, -10, '¡Error! Los animales deberían dejar de ser llamdos animales', NULL, NULL, NULL),
(162, 41, 'las monas', 1, 10, '¡Bien hecho! Las monas hicieron paro de actividades en el circo.', NULL, NULL, NULL),
(163, 41, 'monas y monos', 0, -3, '¡Error! Las monas hicieron paro de actividades en el circo.', NULL, NULL, NULL),
(164, 41, 'los leones', 0, -7, '¡Error! Las monas hicieron paro de actividades en el circo.', NULL, NULL, NULL),
(165, 41, 'los payasos', 0, -10, '¡Error! Las monas hicieron paro de actividades en el circo.', NULL, NULL, NULL),
(166, 42, 'los burros', 1, 10, '¡Bien hecho! Los burros ponían condiciones para sacarse fotos con los chicos en el zoológico.', NULL, NULL, NULL),
(167, 42, 'los leones', 0, -3, '¡Error! Los burros ponían condiciones para sacarse fotos con los chicos en el zoológico.', NULL, NULL, NULL),
(168, 42, 'los gatos', 0, -7, '¡Error! Los burros ponían condiciones para sacarse fotos con los chicos en el zoológico.', NULL, NULL, NULL),
(169, 42, 'los trabajadores del zoológico\n', 0, -10, '¡Error! Los burros ponían condiciones para sacarse fotos con los chicos en el zoológico.', NULL, NULL, NULL),
(170, 43, 'Estudia cómo viven las sociedades y organizan los territorios.\n', 1, 10, '¡Bien hecho!Estudia cómo viven las sociedades y organizan los territorios.', NULL, NULL, NULL),
(171, 43, 'Estudia el relieve  y los recursos humanos.', 0, -3, '¡Error!Estudia cómo viven las sociedades y organizan los territorios.\n', NULL, NULL, NULL),
(172, 43, 'Estudia los fenómenos sociales y regionales.', 0, -7, '¡Error!Estudia cómo viven las sociedades y organizan los territorios.', NULL, NULL, NULL),
(173, 43, 'Se ocupa de las actividades sociales de las personas.', 0, -10, '¡Error!Estudia cómo viven las sociedades y organizan los territorios.', NULL, NULL, NULL),
(174, 44, 'Representaciones gráficas, fotografías, estadísticas y regionalización.', 1, 10, '¡Bien hecho!Representaciones gráficas, fotografías, estadísticas y regionalización.', NULL, NULL, NULL),
(175, 44, 'Representaciones cartográficas y estadísticas.', 0, -3, '¡Error!Representaciones gráficas, fotografías, estadísticas y regionalización.', NULL, NULL, NULL),
(176, 44, 'Los gráficos y mapas.', 0, -7, '¡Error!Representaciones gráficas, fotografías, estadísticas y regionalización.', NULL, NULL, NULL),
(177, 44, 'Las herramientas son los cuestionarios y las investigaciones.', 0, -10, '¡Error!Representaciones gráficas, fotografías, estadísticas y regionalización.', NULL, NULL, NULL),
(178, 45, 'Es una representación gráfica de la superficie terrestre.', 1, 10, '¡ Bien Hecho!Es una representación gráfica de la superficie terrestre.', NULL, NULL, NULL),
(179, 45, 'Representaciones cartográficas.', 0, -3, '¡Error!Es una representación gráfica de la superficie terrestre.', NULL, NULL, NULL),
(180, 45, 'Representaciones de una porción de la tierra.', 0, -7, '¡Error!Es una representación gráfica de la superficie terrestre.', NULL, NULL, NULL),
(181, 45, 'Son dibujos que semejan la parte de la Tierra a estudiar.', 0, -10, '¡Error!Es una representación gráfica de la superficie terrestre.', NULL, NULL, NULL),
(182, 46, 'Es una representación gráfica del total de  la superficie terrestre.', 1, 10, '¡ Bien hecho!Es una representación gráfica del total de  la superficie terrestre.', NULL, NULL, NULL),
(183, 46, 'Es la representación de una parte de la superficie terrestre.', 0, -3, '¡Error!Es una representación gráfica del total de  la superficie terrestre.', NULL, NULL, NULL),
(184, 46, 'Parte de la superficie terrestre.', 0, -7, '¡Error!Es una representación gráfica del total de  la superficie terrestre.', NULL, NULL, NULL),
(185, 46, 'Representa el globo terráqueo.', 0, -10, '¡Error!Es una representación gráfica del total de  la superficie terrestre.', NULL, NULL, NULL),
(186, 47, 'Muestran la organización territorial actual del mundo.', 1, 10, '¡ Bien hecho!Muestran la organización territorial actual del mundo.', NULL, NULL, NULL),
(187, 47, 'Muestran cómo viven las sociedades.', 0, -3, '¡Error!Muestran la organización territorial actual del mundo.', NULL, NULL, NULL),
(188, 47, 'Muestran los problemas de las sociedades.', 0, -7, '¡Error!Muestran la organización territorial actual del mundo.', NULL, NULL, NULL),
(189, 47, 'La divisíon entre países.', 0, -10, '¡Error!Muestran la organización territorial actual del mundo.', NULL, NULL, NULL),
(190, 48, 'Son círculos paralelos al Ecuador.', 1, 10, '¡ Bien hecho!Son círculos paralelos al Ecuador.', NULL, NULL, NULL),
(191, 48, 'Son líneas que van de este a oeste.', 0, -3, '¡Error!Son círculos paralelos al Ecuador.', NULL, NULL, NULL),
(192, 48, 'Son líneas que atraviesan la Tierra.', 0, -7, '¡Error!Son círculos paralelos al Ecuador.', NULL, NULL, NULL),
(193, 48, 'Son porciones de la Tierra imaginarias.', 0, -10, '¡Error!Son círculos paralelos al Ecuador.', NULL, NULL, NULL),
(194, 49, 'Son semicírculos que van de polo a polo.', 1, 10, '¡ Bien hecho!Son semicírculos que van de polo a polo.', NULL, NULL, NULL),
(195, 49, 'Son líneas que cruzan la superficie de norte a sur.', 0, -3, '¡Error!Son semicírculos que van de polo a polo.', NULL, NULL, NULL),
(196, 49, 'Son líneas que van de este a oeste.', 0, -7, '¡Error!Son semicírculos que van de polo a polo.', NULL, NULL, NULL),
(197, 49, 'Son porciones de la Tierra imaginarias.', 0, -10, '¡Error!Son semicírculos que van de polo a polo.', NULL, NULL, NULL),
(198, 50, 'Esla relación entre el tamaño real de la superficie terrestre y el dibujo que se realiza en en papel.', 1, 10, '¡ Bien hecho!Es la relación entre el tamaño real de la superficie terrestre y el dibujo que se realiza en en papel.', NULL, NULL, NULL),
(199, 50, 'Son dibujos más pequeños de una superficie a representar.\n', 0, -3, '¡Error!Es la relación entre el tamaño real de la superficie terrestre y el dibujo que se realiza en en papel.', NULL, NULL, NULL),
(200, 50, 'Son fórmulas que sirven para representar pequeñas superficies.\n', 0, -7, '¡Error!Es la relación entre el tamaño real de la superficie terrestre y el dibujo que se realiza en en papel.', NULL, NULL, NULL),
(201, 50, 'Son mediciones aproximadas de una sperficie a estudiar.', 0, -10, '¡Error!Es la relación entre el tamaño real de la superficie terrestre y el dibujo que se realiza en en papel.', NULL, NULL, NULL),
(202, 51, 'Son representaciones gráficas de pequeñas porciones de la superficie terestre.', 1, 10, '¡ Bien hecho!Son representaciones gráficas de pequeñas porciones de la superficie terestre.', NULL, NULL, NULL),
(203, 51, 'Son partes de mapas y gráficos.\n', 0, -3, '¡Error!Son representaciones gráficas de pequeñas porciones de la superficie terestre.', NULL, NULL, NULL),
(204, 51, 'Representan el relieve de la tierra.', 0, -7, '¡Error!Son representaciones gráficas de pequeñas porciones de la superficie terestre.', NULL, NULL, NULL),
(205, 51, 'Los planos son dibujos hechos sin ningún criterio técnico', 0, -10, '¡Error!Son representaciones gráficas de pequeñas porciones de la superficie terestre.', NULL, NULL, NULL),
(206, 52, 'Son mapas que representan determinados fenómenos de una sociedad.', 1, 10, '¡Bien hecho!Son mapas que representan determinados fenómenos de una sociedad.', NULL, NULL, NULL),
(207, 52, 'Son mapas que representan el relieve.', 0, -3, '¡Error!Son mapas que representan determinados fenómenos de una sociedad.', NULL, NULL, NULL),
(208, 52, 'Muestran la igualdad entre una o dos regiones.', 0, -7, '¡Error!Son mapas que representan determinados fenómenos de una sociedad.', NULL, NULL, NULL),
(209, 52, 'Son datos que no tienen relación con el lugar representado.', 0, -10, '¡Error!Son mapas que representan determinados fenómenos de una sociedad.', NULL, NULL, NULL),
(210, 53, 'A través de cámaras en aviones que vuelan a baja altura.', 1, 10, '¡Bien hecho!A través de cámaras en aviones que vuelan a baja altura.', NULL, NULL, NULL),
(211, 53, 'A través de satélites.', 0, -3, '¡Error!A través de cámaras en aviones que vuelan a baja altura.', NULL, NULL, NULL),
(212, 53, 'A través de cohetes y viajes espaciales.', 0, -7, '¡Error!A través de cámaras en aviones que vuelan a baja altura.', NULL, NULL, NULL),
(213, 53, 'Se toman con diferentes equipos desde la Tierra.', 0, -10, '¡Error!A través de cámaras en aviones que vuelan a baja altura.', NULL, NULL, NULL),
(214, 54, 'Podemos visualizar diferentes fenómenos como la distribución de algún recurso natural.', 1, 10, '¡Bien hecho!Podemos visualizar diferentes fenómenos como la distribución de algún recurso natural.', NULL, NULL, NULL),
(215, 54, 'Podemos visualizar la dinámica de la sociedad.', 0, -3, '¡Error!Podemos visualizar diferentes fenómenos como la distribución de algún recurso natural.', NULL, NULL, NULL),
(216, 54, 'Podemos ver fenómenos locales.', 0, -7, '¡Error!Podemos visualizar diferentes fenómenos como la distribución de algún recurso natural.', NULL, NULL, NULL),
(217, 54, 'Podemos ver las diferentes capas de la superficie terrestre.', 0, -10, '¡Error!Podemos visualizar diferentes fenómenos como la distribución de algún recurso natural.', NULL, NULL, NULL),
(218, 55, 'Es dividir el territorio en porciones más pequeñas.', 1, 10, '¡Bien Hecho!Es dividir el territorio en porciones más pequeñas.', NULL, NULL, NULL),
(219, 55, 'Es conocer una porción del territorio.', 0, -3, '¡Error!Es dividir el territorio en porciones más pequeñas.', NULL, NULL, NULL),
(220, 55, 'Es conocer una parte del terreno sin ningún criterio preestablecido.', 0, -7, '¡Error!Es dividir el territorio en porciones más pequeñas.', NULL, NULL, NULL),
(221, 55, 'Es dividir espacios pequeños en otros para su estudio.', 0, -10, '¡Error!Es dividir el territorio en porciones más pequeñas.', NULL, NULL, NULL),
(222, 60, 'El hijo deforme del rey Minos de Creta', 1, 10, '¡Bien!  El hijo deforme del rey Minos de Creta', NULL, NULL, NULL),
(223, 60, 'El hijo de Poseidón', 0, -3, '¡Error! El hijo deforme del rey Minos de Creta', NULL, NULL, NULL),
(224, 60, 'Un monstruo capturado por los Cretenses', 0, -7, '¡Error! El hijo deforme del rey Minos de Creta', NULL, NULL, NULL),
(225, 60, 'Un guerrero hechizado', 0, -10, '¡Error! El hijo deforme del rey Minos de Creta', NULL, NULL, NULL),
(226, 61, 'Por triunfar en las Olimpíadas', 1, 10, '¡Bien! Por triunfar en las Olimpíadas', NULL, NULL, NULL),
(227, 61, 'Por robar a los atenienses', 0, -3, '¡Error! Por triunfar en las Olimpíadas', NULL, NULL, NULL),
(228, 61, 'Por hacer trampa en las competencias', 0, -7, '¡Error! Por triunfar en las Olimpíadas', NULL, NULL, NULL),
(229, 61, 'Por amenazar a otro competidor', 0, -10, '¡Error! Por triunfar en las Olimpíadas', NULL, NULL, NULL),
(230, 62, 'Matar al Minotauro', 1, 10, '¡Bien! Matar al Minotauro', NULL, NULL, NULL),
(231, 62, 'Ganar la guerra en Creta', 0, -3, '¡Error! Matar al Minotauro', NULL, NULL, NULL),
(232, 62, 'Llevar a los jóvenes y doncellas hasta el laberinto', 0, -7, '¡Error! Matar al Minotauro', NULL, NULL, NULL),
(233, 62, 'Hacer el pago de un impuesto', 0, -10, '¡Error! Matar al Minotauro', NULL, NULL, NULL),
(234, 63, 'Un Velero', 1, 10, '¡Bien! Un Velero', NULL, NULL, NULL),
(235, 63, 'A pie', 0, -3, '¡Error! Un Velero', NULL, NULL, NULL),
(236, 63, 'A caballo', 0, -7, '¡Error! Un Velero', NULL, NULL, NULL),
(237, 63, 'De rodillas, gateando', 0, -10, '¡Error! Un Velero', NULL, NULL, NULL),
(238, 64, 'Teseo', 1, 10, '¡Bien! Teseo', NULL, NULL, NULL),
(239, 64, 'Egeo', 0, -3, '¡Error! Teseo', NULL, NULL, NULL),
(240, 64, 'Minos', 0, -7, '¡Error! Teseo', NULL, NULL, NULL),
(241, 64, 'Androgeo', 0, -10, '¡Error! Teseo', NULL, NULL, NULL),
(242, 65, 'Por su valor y belleza', 1, 10, '¡Bien! Por su valor y belleza', NULL, NULL, NULL),
(243, 65, 'Por su capacidad de diálogo', 0, -3, '¡Error! Por su valor y belleza', NULL, NULL, NULL),
(244, 65, 'Por su solidaridad', 0, -7, '¡Error! Por su valor y belleza', NULL, NULL, NULL),
(245, 65, 'Por su atletismo', 0, -10, '¡Error! Por su valor y belleza', NULL, NULL, NULL),
(246, 66, 'Un hilo', 1, 10, '¡Bien! Un hilo', NULL, NULL, NULL),
(247, 66, 'Una daga', 0, -3, '¡Error! Un hilo', NULL, NULL, NULL),
(248, 66, 'Una capa', 0, -7, '¡Error! Un hilo', NULL, NULL, NULL),
(249, 66, 'Un espejo', 0, -10, '¡Error! Un hilo', NULL, NULL, NULL),
(250, 67, 'Clavándole un arma', 1, 10, '¡Bien! Clavándole un arma', NULL, NULL, NULL),
(251, 67, 'Ahorcándolo', 0, -3, '¡Error! Clavándole un arma', NULL, NULL, NULL),
(252, 67, 'Envenenándolo', 0, -7, '¡Error! Clavándole un arma', NULL, NULL, NULL),
(253, 67, 'Tirándolo por un precipicio', 0, -10, '¡Error! Clavándole un arma', NULL, NULL, NULL),
(254, 68, 'Enrollando el hilo', 1, 10, '¡Bien! Por un túnel subterráneo', NULL, NULL, NULL),
(255, 68, 'Por un túnel subterráneo', 0, -3, '¡Error! Por un túnel subterráneo', NULL, NULL, NULL),
(256, 68, 'Siguiendo migajas', 0, -7, '¡Error! Por un túnel subterráneo', NULL, NULL, NULL),
(257, 68, 'Leyendo un mapa', 0, -10, '¡Error! Por un túnel subterráneo', NULL, NULL, NULL),
(258, 69, 'Se durmió en el bosque', 1, 10, '¡Bien! Se durmió en el bosque', NULL, NULL, NULL),
(259, 69, 'Encontró seres mágicos', 0, -3, '¡Error! Se durmió en el bosque', NULL, NULL, NULL),
(260, 69, 'Se perdió entre la maleza', 0, -7, '¡Error! Se durmió en el bosque', NULL, NULL, NULL),
(261, 69, 'Recolectó víveres para el viaje', 0, -10, '¡Error! Se durmió en el bosque', NULL, NULL, NULL),
(263, 74, 'Un tío a su sobrina', 1, 10, '¡Bien hecho! Un tío a su sobrina', '2016-05-17 14:32:44', '2016-05-17 14:32:44', NULL),
(264, 74, 'Un padre a su hija', 0, -3, '¡Error! Un tío a su sobrina', '2016-05-17 14:33:09', '2016-05-17 14:33:09', NULL),
(265, 74, 'Un abuelo a su nieta', 0, -7, '¡Error! Un tío a su sobrina', '2016-05-17 14:33:27', '2016-05-17 14:33:27', NULL),
(266, 74, 'Un primo a una prima', 0, -10, '¡Error! Un tío a su sobrina', '2016-05-17 14:33:40', '2016-05-17 14:33:40', NULL),
(267, 75, 'Buenos Aires', 1, 10, '¡Bien hecho! En Buenos Aires', '2016-05-17 14:34:02', '2016-05-17 14:34:02', NULL),
(268, 75, 'Santa Fe', 0, -3, '¡Error! En Buenos Aires', '2016-05-17 14:34:16', '2016-05-17 14:34:16', NULL),
(269, 75, 'La Pampa', 0, -7, '¡Error! En Buenos Aires', '2016-05-17 14:34:32', '2016-05-17 14:34:32', NULL),
(270, 75, 'Entre Ríos', 0, -10, '¡Error! En Buenos Aires', '2016-05-17 14:34:46', '2016-05-17 14:34:46', NULL),
(271, 76, 'Martina , Camila y Oriana', 1, 10, '¡Bien Hecho! Martina, Camila y Oriana', '2016-05-17 14:35:13', '2016-05-17 14:35:13', NULL),
(272, 76, ' Martina, Celina y Ornella', 0, -3, 'Error! Martina, Camila y Oriana', '2016-05-17 14:35:43', '2016-05-17 14:35:43', NULL),
(273, 76, 'Melinda, Camila y Oriana', 0, -7, 'Error! Martina, Camila y Oriana', '2016-05-17 14:36:03', '2016-05-17 14:36:03', NULL),
(274, 76, 'Martina, Celina y Oriana', 0, -10, 'Error! Martina, Camila y Oriana', '2016-05-17 14:36:12', '2016-05-17 14:36:12', NULL),
(275, 77, 'Tap', 1, 10, '¡Bien hecho! Tap', '2016-05-17 14:36:57', '2016-05-17 14:36:57', NULL),
(276, 77, 'Folklore', 0, -3, '¡Error! Tap', '2016-05-17 14:37:12', '2016-05-17 14:37:12', NULL),
(277, 77, 'Tango', 0, -7, '¡Error! Tap', '2016-05-17 14:37:26', '2016-05-17 14:37:26', NULL),
(278, 77, 'Clásico', 0, -10, '¡Error! Tap', '2016-05-17 14:37:39', '2016-05-17 14:37:39', NULL),
(279, 78, 'Primer piso', 1, 10, '¡Bien hecho! Primer Piso\n', '2016-05-17 14:45:26', '2016-05-17 14:45:26', NULL),
(280, 78, 'Subsuelo', 0, -3, '¡Error! Primer Piso', '2016-05-17 14:45:42', '2016-05-17 14:45:42', NULL),
(281, 78, 'Altillo', 0, -7, '¡Error! Primer Piso', '2016-05-17 14:46:02', '2016-05-17 14:46:02', NULL),
(282, 78, 'Segundo Piso', 0, -10, '¡Error! Primer Piso', '2016-05-17 14:46:16', '2016-05-17 14:46:16', NULL),
(283, 79, 'Porque la abuela se descompuso', 1, 10, '¡Bien hecho! Porque la abuela se descompuso', '2016-05-17 14:46:52', '2016-05-17 14:46:52', NULL),
(284, 79, 'Por inundación', 0, -3, '¡Error! Porque la abuela se descompuso', '2016-05-17 14:47:07', '2016-05-17 14:47:07', NULL),
(285, 79, 'Por trabajo del padre', 0, -7, '¡Error! Porque la abuela se descompuso', '2016-05-17 14:47:16', '2016-05-17 14:47:16', NULL),
(286, 79, 'Porque se quedaron sin electricidad', 0, -10, '¡Error! Porque la abuela se descompuso', '2016-05-17 14:47:24', '2016-05-17 14:47:24', NULL),
(287, 80, 'Tenía miedo a la tormenta', 1, 10, '¡Bien hecho! Tenía miedo a la tormenta', '2016-05-17 14:47:48', '2016-05-17 14:47:48', NULL),
(288, 80, 'Extrañaba a sus padres', 0, -3, '¡Error! Tenía miedo a la tormenta', '2016-05-17 14:48:05', '2016-05-17 14:48:05', NULL),
(289, 80, 'Se peleó con sus amigas', 0, -7, '¡Error! Tenía miedo a la tormenta', '2016-05-17 14:48:15', '2016-05-17 14:48:15', NULL),
(290, 80, 'La dejaron sola', 0, -10, '¡Error! Tenía miedo a la tormenta', '2016-05-17 14:48:24', '2016-05-17 14:48:24', NULL),
(291, 81, 'Se taparon bien, estiraron sus brazoz y agarraron sus manos', 1, 10, '¡Bien hecho! Se taparon bien, estiraron los brazos y tomaron sus manos', '2016-05-17 14:48:42', '2016-05-17 14:48:42', NULL),
(292, 81, ' Se taparon bien, cerraron sus ojos y cantaron', 0, -3, '¡Error! Se taparon bien, estiraron los brazos y tomaron sus manos', '2016-05-17 14:48:58', '2016-05-17 14:48:58', NULL),
(293, 81, 'Cerraron sus ojos y contaron historias de amor', 0, -7, '¡Error! Se taparon bien, estiraron los brazos y tomaron sus manos', '2016-05-17 14:49:06', '2016-05-17 14:49:06', NULL),
(294, 81, 'Se taparon bien, estiraron los brazos y con sus manos hacían sombras sobre la pared', 0, -10, '¡Error! Se taparon bien, estiraron los brazos y tomaron sus manos', '2016-05-17 14:49:18', '2016-05-17 14:49:18', NULL),
(295, 82, 'Dormían plácidamente', 1, 10, '¡Bien hecho! Dormían plácidamente', '2016-05-17 14:49:37', '2016-05-17 14:49:37', NULL),
(296, 82, 'No estaban', 0, -3, '¡Error! Dormían plácidamente', '2016-05-17 14:49:52', '2016-05-17 14:49:52', NULL),
(297, 82, 'Estaban petrificadas', 0, -7, '¡Error! Dormían plácidamente', '2016-05-17 14:50:04', '2016-05-17 14:50:04', NULL),
(298, 82, 'Dormían todas juntas en una cama', 0, -10, '¡Error! Dormían plácidamente', '2016-05-17 14:50:17', '2016-05-17 14:50:17', NULL),
(299, 83, 'Sus manos no se unían por más que lo intentaran.', 1, 10, '¡Bien hecho! Sus manos no se unían por más que lo intentaran', '2016-05-17 14:50:37', '2016-05-17 14:50:37', NULL),
(300, 83, 'Se tomaron de las manos sin dificultad', 0, -3, '¡Error! Sus manos no se unían por más que lo intentaran', '2016-05-17 14:51:01', '2016-05-17 14:51:01', NULL),
(301, 83, ' Los adultos las ayudaron a acercar las camas', 0, -7, '¡Error! Sus manos no se unían por más que lo intentaran', '2016-05-17 14:51:12', '2016-05-17 14:51:12', NULL),
(302, 83, 'Encontraron seres aterradores debajo de sus camas', 0, -10, '¡Error! Sus manos no se unían por más que lo intentaran', '2016-05-17 14:51:27', '2016-05-17 14:51:27', NULL),
(303, 84, 'Organismo Genéticamente Modificado', 1, 10, '¡Bien hecho! Organismo Genéticamente Modificado', '2016-06-14 14:35:28', '2016-06-14 14:35:28', NULL),
(304, 84, 'Organismo Gentilmente Modificado', 0, -3, '¡Error! Organismo Genéticamente Modificado', '2016-06-14 14:35:59', '2016-06-14 14:35:59', NULL),
(305, 84, 'Organización General de Medios.', 0, -7, '¡Error! Organismo Genéticamente Modificado', '2016-06-14 14:36:15', '2016-06-14 14:36:15', NULL),
(306, 84, 'Organización General Moderna.', 0, -10, '¡Error! Organismo Genéticamente Modificado', '2016-06-14 14:36:39', '2016-06-14 14:36:39', NULL),
(307, 85, 'Es un organismo animal o vegetal que ha sufrido un cambio en su información genética y características.', 1, 10, '¡Bien hecho! Es un organismo animal o vegetal que ha sufrido un cambio en su información genética y características.', '2016-06-14 14:37:01', '2016-06-14 14:37:01', NULL),
(308, 85, 'Es un organismo vegetal o animal que ha sufrido un cambio en su información genética.', 0, -3, '¡Error! Es un organismo animal o vegetal que ha sufrido un cambio en su información genética y características.', '2016-06-14 14:38:20', '2016-06-14 14:38:20', NULL),
(309, 85, ' Es un organismo vegetal que ha sufrido un cambio en su información genética y características.', 0, -7, '¡Error! Es un organismo animal o vegetal que ha sufrido un cambio en su información genética y características.', '2016-06-14 14:38:31', '2016-06-14 14:38:31', NULL),
(310, 85, 'Es un organismo animal que ha sufrido un cambio en su información genética y características.', 0, -10, '¡Error! Es un organismo animal o vegetal que ha sufrido un cambio en su información genética y características.', '2016-06-14 14:38:40', '2016-06-14 14:38:40', NULL),
(311, 86, 'Porque se lo quiere dotar de propiedades que no son naturales para él', 1, 10, '¡Bien hecho! Porque se lo quiere dotar de propiedades que no son naturales para él', '2016-06-14 14:39:08', '2016-06-14 14:39:08', NULL),
(312, 86, 'Para hacer más vistoso al ser vivo.', 0, -3, '¡Error! Porque se lo quiere dotar de propiedades que no son naturales para él', '2016-06-14 14:39:42', '2016-06-14 14:39:42', NULL),
(313, 86, 'Porque se le quiere agregar nuevas funciones.', 0, -7, '¡Error! Porque se lo quiere dotar de propiedades que no son naturales para él', '2016-06-14 14:39:53', '2016-06-14 14:39:53', NULL),
(314, 86, 'Para que pueda realizar muchas funciones a la vez.', 0, -10, '¡Error! Porque se lo quiere dotar de propiedades que no son naturales para él', '2016-06-14 14:40:07', '2016-06-14 14:40:07', NULL),
(315, 87, 'Sobre los casos de inserción de material hereditario', 1, 10, '¡Bien hecho! Sobre los casos de inserción de material hereditario', '2016-06-14 14:41:29', '2016-06-14 14:41:29', NULL),
(316, 87, 'El pronóstico del tiempo y actualidad política', 0, -3, '¡Error! Sobre los casos de inserción de material hereditario', '2016-06-14 14:42:00', '2016-06-14 14:42:00', NULL),
(317, 87, 'Sobre los avances de la ciencia en materia de animales y vegetales.', 0, -7, '¡Error! Sobre los casos de inserción de material hereditario', '2016-06-14 14:42:25', '2016-06-14 14:42:25', NULL),
(318, 87, 'Sobre las dificultades que surgen por la manipulación genética.', 0, -10, '¡Error! Sobre los casos de inserción de material hereditario', '2016-06-14 14:42:48', '2016-06-14 14:42:48', NULL),
(319, 88, 'Plantas modificadas genéticamente que pueden crecer más rápido, y producir frutos más grandes, y más nutritivos.', 1, 10, '¡Bien hecho! Plantas modificadas genéticamente que pueden crecer más rápido, y producir frutos más grandes, y más nutritivos.', '2016-06-14 14:43:19', '2016-06-14 14:43:19', NULL),
(320, 88, 'Plantas modificadas genéticamente que pueden reproducirse con mayor velocidad', 0, -3, '¡Error! Plantas modificadas genéticamente que pueden crecer más rápido, y producir frutos más grandes, y más nutritivos.', '2016-06-14 14:43:43', '2016-06-14 14:43:43', NULL),
(321, 88, 'Plantas carnívoras que producen antídotos para las enfermedades', 0, -7, '¡Error! Plantas modificadas genéticamente que pueden crecer más rápido, y producir frutos más grandes, y más nutritivos.', '2016-06-14 14:43:57', '2016-06-14 14:43:57', NULL),
(322, 88, 'Plantas importadas que ayudan a conservar especies en extinción. ', 0, -10, '¡Error! Plantas modificadas genéticamente que pueden crecer más rápido, y producir frutos más grandes, y más nutritivos.', '2016-06-14 14:44:09', '2016-06-14 14:44:09', NULL),
(323, 89, 'Aún no se saben.', 1, 10, '¡Bien hecho!Aún no se saben.', '2016-06-14 14:44:29', '2016-06-14 14:44:29', NULL),
(324, 89, 'Enfermedades mortales', 0, -3, '¡Error! Aún no se saben.', '2016-06-14 14:44:49', '2016-06-14 14:44:49', NULL),
(325, 89, ' Creación de nuevas especies', 0, -7, '¡Error! Aún no se saben.', '2016-06-14 14:44:57', '2016-06-14 14:44:57', NULL),
(326, 89, 'Se conocen pero los científicos se niegan a contarlas', 0, -10, '¡Error! Aún no se saben.', '2016-06-14 14:45:09', '2016-06-14 14:45:09', NULL),
(327, 90, 'Está prohibida en la Unión Europea.', 1, 10, '¡Bien hecho!Está prohibida en la Unión Europea.', '2016-06-14 14:45:28', '2016-06-14 14:45:28', NULL),
(328, 90, 'Está prohibida en Estados Unidos, Canadá y Argentina', 0, -3, '¡Error! Está prohibida en la Unión Europea.', '2016-06-14 14:45:44', '2016-06-14 14:45:44', NULL),
(329, 90, 'Está prohibida en Estados Unidos y Canadá.', 0, -7, '¡Error! Está prohibida en la Unión Europea.', '2016-06-14 14:46:01', '2016-06-14 14:46:01', NULL),
(330, 90, 'Está prohibida en la Unión Europea y Argentina', 0, -10, '¡Error! Está prohibida en la Unión Europea.', '2016-06-14 14:46:22', '2016-06-14 14:46:22', NULL),
(331, 91, 'Los seres vivos y sus descendientes.', 1, 10, '¡Bien hecho! Los seres vivos y sus descendientes.', '2016-06-14 14:46:41', '2016-06-14 14:46:41', NULL),
(332, 91, 'Los seres humanos y sus descendientes', 0, -3, '¡Error! Los seres vivos y sus descendientes.', '2016-06-14 14:46:58', '2016-06-14 14:46:58', NULL),
(333, 91, 'Los monumentos históricos del mundo', 0, -7, '¡Error! Los seres vivos y sus descendientes.', '2016-06-14 14:47:13', '2016-06-14 14:47:13', NULL),
(334, 91, 'Los animales y sus descendientes.', 0, -10, '¡Error! Los seres vivos y sus descendientes.', '2016-06-14 14:47:23', '2016-06-14 14:47:23', NULL),
(335, 92, 'La región del Alto Perú', 1, 10, '¡Bien hecho! La región del Alto Perú', '2016-07-06 12:48:27', '2016-07-06 12:48:27', NULL),
(336, 93, 'En un convento', 1, 10, '¡Bien hecho! En un convento', '2016-07-06 12:48:51', '2016-07-06 12:48:51', NULL),
(337, 94, '5 hijos', 1, 10, '¡ Bien hecho! 5 hijos', '2016-07-06 12:49:16', '2016-07-06 12:49:16', NULL),
(338, 95, 'Muchas mujeres se incorporaban a los ejércitos', 1, 10, '¡Error! Muchas mujeres se incorporaban a los ejércitos', '2016-07-06 12:49:35', '2016-07-06 12:49:35', NULL),
(339, 96, 'Los Leales', 1, 10, '¡Error! Los Leales', '2016-07-06 12:49:56', '2016-07-06 12:49:56', NULL),
(340, 97, 'Le regalo su propia espada', 1, 10, '¡Error! Le regalo su propia espada', '2016-07-06 12:50:14', '2016-07-06 12:50:14', NULL),
(341, 98, 'Arrebató la bandera de las fuerzas enemigas.', 1, 10, '¡Error! Arrebató la bandera de las fuerzas enemigas.', '2016-07-06 12:50:32', '2016-07-06 12:50:32', NULL),
(342, 99, 'En la provincia de Jujuy, en la completa miseria.', 1, 10, '¡Error! En la provincia de Jujuy, en la completa miseria.', '2016-07-06 12:50:50', '2016-07-06 12:50:50', NULL),
(343, 92, 'La región de Perú', 0, -3, '¡Error! La región del Alto Perú', '2016-07-06 12:51:16', '2016-07-06 12:51:16', NULL),
(345, 93, 'En la calle', 0, -3, '¡Error! En un convento', '2016-07-06 12:51:58', '2016-07-06 12:51:58', NULL),
(346, 94, '4 hijos', 0, -3, '¡Error! 5 hijos', '2016-07-06 12:52:17', '2016-07-06 12:52:17', NULL),
(347, 92, 'La legión de Perú.', 0, -7, '¡Error! La región del Alto Perú', '2016-07-06 12:52:53', '2016-07-06 12:52:53', NULL),
(348, 92, 'La región mesopotámica', 0, -10, '¡Error! La región del Alto Perú', '2016-07-06 12:53:05', '2016-07-06 12:53:05', NULL),
(349, 93, 'Entrando en el ejército', 0, -7, '¡Error! En un convento', '2016-07-06 12:53:57', '2016-07-06 12:53:57', NULL),
(350, 93, 'Huyendo', 0, -10, '¡Error! En un convento\n', '2016-07-06 12:54:13', '2016-07-06 12:54:13', NULL),
(351, 94, '6 hijos', 0, -7, '¡Error! 5 hijos', '2016-07-06 12:54:27', '2016-07-06 12:54:27', NULL),
(352, 94, '3 hijos', 0, -10, '¡Error! 5 hijos', '2016-07-06 12:54:40', '2016-07-06 12:54:40', NULL),
(353, 95, 'Juana fue una excepción en la incorporación a los ejércitos', 0, -3, '¡Error! Muchas mujeres se incorporaban a los ejércitos', '2016-07-06 12:54:59', '2016-07-06 12:54:59', NULL),
(354, 95, 'Las mujeres no querían a Juana en el ejército', 0, -7, '¡Error! Muchas mujeres se incorporaban a los ejércitos', '2016-07-06 12:55:15', '2016-07-06 12:55:15', NULL),
(355, 95, 'Los hombres no querían a las mujeres en el ejército', 0, -10, '¡Error! Muchas mujeres se incorporaban a los ejércitos', '2016-07-06 12:55:31', '2016-07-06 12:55:31', NULL),
(356, 96, 'Los Mortales', 0, -3, '¡Error! Los Leales', '2016-07-06 12:55:46', '2016-07-06 12:55:46', NULL),
(357, 96, 'Los Letales', 0, -7, '¡Error! Los Leales', '2016-07-06 12:55:57', '2016-07-06 12:55:57', NULL),
(358, 96, 'Los Altares', 0, -10, '¡Error! Los Leales', '2016-07-06 12:56:10', '2016-07-06 12:56:10', NULL),
(359, 97, 'Le entregó una medalla', 0, -3, '¡Error! Le regalo su propia espada', '2016-07-06 12:56:27', '2016-07-06 12:56:27', NULL),
(360, 97, 'Le dejó una carta', 0, -7, '¡Error! Le regalo su propia espada', '2016-07-06 12:56:47', '2016-07-06 12:56:47', NULL),
(361, 97, 'Le pidió que se quedará luchando', 0, -10, '¡Error! Le regalo su propia espada', '2016-07-06 12:57:17', '2016-07-06 12:57:17', NULL),
(362, 98, 'Arrebató el orgullo a las fuerzas enemigas', 0, -3, '¡Error! Arrebató la bandera de las fuerzas enemigas.', '2016-07-06 12:57:38', '2016-07-06 12:57:38', NULL),
(487, 106, 'Irlanda', 1, 10, '¡Bien hecho! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(488, 106, 'Inglaterra', 0, -3, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(489, 106, 'Francia', 0, -7, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(490, 106, 'Argentina', 0, -10, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(491, 107, '22 de junio de 1777', 1, 10, '¡Bien hecho! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(492, 107, '26 de febrero de 1778', 0, -3, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(493, 107, '22 de junio de 1815', 0, -7, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(494, 107, '9 de julio de 1816', 0, -10, '¡Error! El Almirante Brown nació en Irlanda el 22 de junio de 1777', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(495, 108, '3 de marzo de 1857', 1, 10, '¡Bien hecho! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(496, 108, '17 de agosto de 1850', 0, -3, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(497, 108, '9 de enero de 1870', 0, -7, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(498, 108, '7 de septiembre de 1920', 0, -10, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL);
INSERT INTO `mp_pregunta_opciones` (`id`, `mp_pregunta_id`, `texto`, `es_correcta`, `puntos`, `comentario`, `created`, `modified`, `deleted`) VALUES
(499, 109, 'Buenos Aires', 1, 10, '¡Bien hecho! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(500, 109, 'Montevideo', 0, -3, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(501, 109, 'Londres', 0, -7, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(502, 109, 'Boulong sur Mer', 0, -10, '¡Error! El Almirante Brown falleció en Buenos Aires el 3 de marzo de 1857', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(503, 110, 'Se embarcó como ayudante en un barco norteamericano', 1, 10, '¡Bien hecho! Se embarcó como ayudante en un barco norteamericano', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(504, 110, 'se embarcó como ayudante en un barco inglés', 0, -3, '¡Error! Se embarcó como ayudante en un barco norteamericano', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(505, 110, 'Estudio en la Armada Inglesa', 0, -7, '¡Error! Se embarcó como ayudante en un barco norteamericano', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(506, 110, 'Nunca supo navegar', 0, -10, '¡Error! Se embarcó como ayudante en un barco norteamericano', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(507, 111, 'La valentía y la astucia', 1, 10, '¡Bien hecho! La valentía y la astucia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(508, 111, 'La honradez y la lealtad', 0, -3, '¡Error! La valentía y la astucia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(509, 111, 'La puntualidad y la inteligencia', 0, -7, '¡Error! La valentía y la astucia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(510, 111, 'La devoción y la frugalidad', 0, -10, '¡Error! La valentía y la astucia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(511, 112, 'Un buque inglés', 1, 10, '¡Bien hecho!Un buque inglés', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(512, 112, 'La armada francesa', 0, -3, '¡Error! Un buque inglés', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(513, 112, 'Los piratas del Caribe', 0, -7, '¡Error! Un buque inglés', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(514, 112, 'Piratas turcos', 0, -10, '¡Error! Un buque inglés', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(515, 113, 'En Francia', 1, 10, '¡Bien hecho!En Francia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(516, 113, 'En Inglaterra', 0, -3, '¡Error! En Francia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(517, 113, 'En Buenos Aires', 0, -7, '¡Error! En Francia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(518, 114, 'Diez años', 1, 10, '¡Bien hecho! Diez años', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(519, 114, 'Doce años', 0, -3, '¡Error! Diez años', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(520, 114, 'Quince años', 0, -7, '¡Error! Diez años', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(521, 114, 'Veinte años', 0, -10, '¡Error! Diez años', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(522, 115, 'Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', 1, 10, '¡Bien hecho! Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(523, 115, 'Algo bueno', 0, -3, '¡Error!Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(524, 115, 'Ser estudioso', 0, -7, '¡Error!Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(525, 115, 'Un hecho casual', 0, -10, '¡Error!Es un rasgo característico que distinguen y define a las personas, los seres vivos en general y las cosas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(526, 116, 'Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', 1, 10, '¡Bien hecho! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(527, 116, 'Los que querían instalar una monarquía en América', 0, -3, '¡Error! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(528, 116, 'Los que querían imponer el real como moneda corriente en América', 0, -7, '¡Error! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(529, 116, 'Una corriente filosófica que sostiene "la unica verdad es la realidad"', 0, -10, '¡Error! Los habitantes de América que sostenían la soberanía de la corona española sobre los territorios americanos', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(530, 117, 'Para dedicarse al comercio', 1, 10, '¡Bien hecho! Para dedicarse al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(531, 117, 'A liberar las colonias de América', 0, -3, '¡Error! Para dedicarse al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(532, 117, 'Para catequizar a los indigenas nativos', 0, -7, '¡Error! Para dedicarse al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(533, 117, 'Para hacer turismo', 0, -10, '¡Error! Para dedicarse al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(534, 118, 'Montevideo', 1, 10, '¡Bien hecho! Montevideo', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(535, 118, 'Buenos Aires', 0, -3, '¡Error! Montevideo', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(536, 118, 'Río de Janeiro', 0, -7, '¡Error! Montevideo', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(537, 118, 'Boulong sur Mer', 0, -10, '¡Error! Montevideo', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(538, 119, 'Casado con una hija', 1, 10, '¡Bien hecho! Casado con una hija', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(539, 119, 'Soltero', 0, -3, '¡Error! Casado con una hija', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(540, 119, 'Viudo', 0, -7, '¡Error! Casado con una hija', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(541, 120, 'El 18 de abril de 1810 ', 1, 10, '¡Bien hecho! El 18 de abril de 1810 ', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(542, 120, 'El 25 de mayo de 1810', 0, -3, '¡Error! El 18 de abril de 1810 ', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(543, 120, 'El 9 de julio de 1816', 0, -7, '¡Error! El 18 de abril de 1810 ', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(544, 120, 'El 30 de agosto de 1843', 0, -10, '¡Error! El 18 de abril de 1810 ', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(545, 121, 'El 15 de marzo de 1814', 1, 10, '¡Bien hecho! El 15 de marzo de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(546, 121, 'El 18 de abril de 1810 ', 0, -3, '¡Error! El 15 de marzo de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(547, 121, 'El 9 de julio de 1816', 0, -7, '¡Error! El 15 de marzo de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(548, 121, 'El 3 de junio de 1852', 0, -10, '¡Error! El 15 de marzo de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(549, 122, 'Nunca, Montevideo la tomaron las fuerzas terrestes', 1, 10, '¡Bien hecho! Nunca, Montevideo la tomaron las fuerzas terrestes', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(550, 122, 'El 23 de junio de 1814', 0, -3, '¡Error! Nunca, Montevideo la tomaron las fuerzas terrestes', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(551, 122, 'El 9 de julio de 1816', 0, -7, '¡Error! Nunca, Montevideo la tomaron las fuerzas terrestes', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(552, 122, 'El 22 de abril de 1845', 0, -10, '¡Error! Nunca, Montevideo la tomaron las fuerzas terrestes', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(553, 123, 'El 23 de junio de 1814', 1, 10, '¡Bien hecho! El 23 de junio de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(554, 123, 'El 14 de agosto de 1817', 0, -3, '¡Error! El 23 de junio de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(555, 123, 'El 20 de diciembre de 1830', 0, -7, '¡Error! El 23 de junio de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(556, 123, 'El 15 de octubre de 1845', 0, -10, '¡Error! El 23 de junio de 1814', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(557, 124, 'Un barco de madera, propulsado a velas', 1, 10, '¡Bien hecho! Un barco de madera, propulsado a velas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(558, 124, 'Un bote de remos, muy veloz', 0, -3, '¡Error! Un barco de madera, propulsado a velas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(559, 124, 'Una balsa', 0, -7, '¡Error! Un barco de madera, propulsado a velas', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(560, 125, 'Hércules', 1, 10, '¡Bien hecho! Hércules', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(561, 125, 'Sansón', 0, -3, '¡Error! Hércules', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(562, 125, 'Libertad', 0, -7, '¡Error! Hércules', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(563, 125, 'HSM Warrior', 0, -10, '¡Error! Hércules', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(564, 126, 'Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', 1, 10, '¡Bien hecho! Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(565, 126, 'Atacó a los realistas en las costas de Chile, Perú, Bolivia y Venezuela', 0, -3, '¡Error! Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(566, 126, 'Atacó a los realistas en las costas de Perú,  Colombia  Venezuela', 0, -7, '¡Error! Atacó a los realistas en las costas de Chile, Perú, Ecuador y Colombia', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(567, 127, 'Se retiró a su hogar y se dedicó al comercio', 1, 10, '¡Bien hecho! Se retiró a su hogar y se dedicó al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(568, 127, 'Se retiró a su hogar', 0, -3, '¡Error! Se retiró a su hogar y se dedicó al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(569, 127, 'Participó en el conflicto entre unitarios y federales', 0, -7, '¡Error! Se retiró a su hogar y se dedicó al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL),
(570, 127, 'Se embarcó de regreso a Irlanda', 0, -10, '¡Error! Se retiró a su hogar y se dedicó al comercio', '2016-08-18 18:26:07', '2016-08-18 18:26:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mp_pregunta_tipos`
--

CREATE TABLE IF NOT EXISTS `mp_pregunta_tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mp_pregunta_tipos`
--

INSERT INTO `mp_pregunta_tipos` (`id`, `descripcion`) VALUES
(1, 'Multiple Choice'),
(2, 'Multiple Choice Respuesta Compuesta');

-- --------------------------------------------------------

--
-- Table structure for table `partidas`
--

CREATE TABLE IF NOT EXISTS `partidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `juego_id` int(11) NOT NULL,
  `grado_id` int(11) DEFAULT NULL,
  `partida_estado_id` int(11) NOT NULL,
  `usuario_creador_id` int(11) DEFAULT NULL,
  `mp_tiempo_pregunta` int(11) NOT NULL DEFAULT '0',
  `pregunta_activa_id` int(11) DEFAULT NULL,
  `mp_cantidad_preguntas` int(11) NOT NULL,
  `contenido_disponible` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `partidas`
--

INSERT INTO `partidas` (`id`, `juego_id`, `grado_id`, `partida_estado_id`, `usuario_creador_id`, `mp_tiempo_pregunta`, `pregunta_activa_id`, `mp_cantidad_preguntas`, `contenido_disponible`, `created`, `modified`, `deleted`) VALUES
(1, 7, 1, 1, 21, 60, 1, 5, 1, '2016-07-06 13:00:47', '2016-07-25 15:38:07', NULL),
(2, 1, NULL, 4, 1, 30, 1, 3, 1, '2016-07-21 18:28:53', '2016-07-29 15:16:34', NULL),
(3, 1, NULL, 1, 1, 60, 1, 3, 1, '2016-07-21 18:48:52', '2016-08-04 18:56:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partida_equipos`
--

CREATE TABLE IF NOT EXISTS `partida_equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida_id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `puntos` int(11) DEFAULT '0',
  `puntos_normalizados` int(11) NOT NULL DEFAULT '0',
  `color` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `partida_equipos`
--

INSERT INTO `partida_equipos` (`id`, `partida_id`, `nombre`, `puntos`, `puntos_normalizados`, `color`, `created`, `modified`, `deleted`) VALUES
(1, 1, 'Equipo 1', 0, 0, 'rgb(240, 80, 80)', '2016-07-06 13:01:45', '2016-07-25 15:34:59', NULL),
(2, 1, 'Equipo 2', 0, 0, 'rgb(93, 156, 236)', '2016-07-06 13:02:29', '2016-07-25 15:34:59', NULL),
(3, 1, 'Equipo 3', 0, 0, 'rgb(129, 200, 104)', '2016-07-06 13:02:47', '2016-07-25 15:34:59', NULL),
(4, 1, 'Equipo 4', 0, 0, 'rgb(114, 102, 186)', '2016-07-06 13:03:13', '2016-07-25 15:34:59', NULL),
(5, 1, 'Equipo 5', 0, 0, 'rgb(255, 189, 74)', '2016-07-06 13:03:34', '2016-07-25 15:34:59', NULL),
(6, 1, 'Equipo 6', 0, 0, 'rgb(52, 211, 235)', '2016-07-06 13:03:54', '2016-07-25 15:34:59', NULL),
(7, 3, 'rojo', 0, 0, 'rgb(240, 80, 80)', '2016-07-21 18:49:10', '2016-08-01 14:32:02', NULL),
(8, 2, 'red', 0, 0, 'rgb(240, 80, 80)', '2016-07-21 18:53:01', '2016-07-29 14:35:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partida_equipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `partida_equipos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_partida_equipos_usuarios_equipo` (`partida_id`,`equipo_id`),
  KEY `i_partida_equipos_usuarios_usuario` (`partida_id`,`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `partida_equipos_usuarios`
--

INSERT INTO `partida_equipos_usuarios` (`id`, `partida_id`, `equipo_id`, `usuario_id`, `created`) VALUES
(1, 1, 1, 22, '2016-07-06 13:01:50'),
(2, 1, 1, 39, '2016-07-06 13:01:53'),
(3, 1, 1, 36, '2016-07-06 13:02:23'),
(4, 1, 2, 23, '2016-07-06 13:02:36'),
(6, 1, 2, 40, '2016-07-06 13:02:41'),
(7, 1, 3, 31, '2016-07-06 13:02:54'),
(8, 1, 3, 30, '2016-07-06 13:03:01'),
(9, 1, 3, 37, '2016-07-06 13:03:04'),
(10, 1, 4, 24, '2016-07-06 13:03:21'),
(11, 1, 4, 26, '2016-07-06 13:03:24'),
(13, 1, 5, 35, '2016-07-06 13:03:42'),
(14, 1, 5, 38, '2016-07-06 13:03:44'),
(15, 1, 5, 44, '2016-07-06 13:03:47'),
(16, 1, 5, 34, '2016-07-06 13:04:06'),
(17, 1, 6, 32, '2016-07-06 13:04:08'),
(18, 1, 6, 27, '2016-07-06 13:04:11'),
(19, 1, 6, 25, '2016-07-06 13:04:14'),
(20, 2, 8, 60, '2016-07-21 18:53:03'),
(21, 3, 7, 60, '2016-07-29 15:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `partida_equipos_usuarios_templates`
--

CREATE TABLE IF NOT EXISTS `partida_equipos_usuarios_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grado_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `equipo_nombre` varchar(250) NOT NULL,
  `equipo_color` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `partida_equipos_usuarios_templates`
--

INSERT INTO `partida_equipos_usuarios_templates` (`id`, `grado_id`, `usuario_id`, `categoria_id`, `equipo_nombre`, `equipo_color`) VALUES
(39, 1, 22, 2, 'Equipo 1', 'rgb(240, 80, 80)'),
(40, 1, 36, 2, 'Equipo 1', 'rgb(240, 80, 80)'),
(41, 1, 39, 2, 'Equipo 1', 'rgb(240, 80, 80)'),
(42, 1, 23, 2, 'Equipo 2', 'rgb(93, 156, 236)'),
(43, 1, 40, 2, 'Equipo 2', 'rgb(93, 156, 236)'),
(44, 1, 30, 2, 'Equipo 3', 'rgb(129, 200, 104)'),
(45, 1, 31, 2, 'Equipo 3', 'rgb(129, 200, 104)'),
(46, 1, 37, 2, 'Equipo 3', 'rgb(129, 200, 104)'),
(47, 1, 24, 2, 'Equipo 4', 'rgb(114, 102, 186)'),
(48, 1, 26, 2, 'Equipo 4', 'rgb(114, 102, 186)'),
(49, 1, 34, 2, 'Equipo 5', 'rgb(255, 189, 74)'),
(50, 1, 35, 2, 'Equipo 5', 'rgb(255, 189, 74)'),
(51, 1, 38, 2, 'Equipo 5', 'rgb(255, 189, 74)'),
(52, 1, 44, 2, 'Equipo 5', 'rgb(255, 189, 74)'),
(53, 1, 25, 2, 'Equipo 6', 'rgb(52, 211, 235)'),
(54, 1, 27, 2, 'Equipo 6', 'rgb(52, 211, 235)'),
(55, 1, 32, 2, 'Equipo 6', 'rgb(52, 211, 235)');

-- --------------------------------------------------------

--
-- Table structure for table `partida_estados`
--

CREATE TABLE IF NOT EXISTS `partida_estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `partida_estados`
--

INSERT INTO `partida_estados` (`id`, `descripcion`) VALUES
(0, 'Borrador'),
(2, 'Comenzando'),
(1, 'Esperando'),
(3, 'En pregunta'),
(4, 'En resultados'),
(5, 'Finalizada');

-- --------------------------------------------------------

--
-- Table structure for table `partida_usuarios`
--

CREATE TABLE IF NOT EXISTS `partida_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `puntos` int(11) DEFAULT '0',
  `puntos_normalizados` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `last_connection` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_partida_usuarios_partida` (`partida_id`),
  KEY `i_partida_usuarios_usuario` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `partida_usuarios`
--

INSERT INTO `partida_usuarios` (`id`, `partida_id`, `usuario_id`, `rol_id`, `puntos`, `puntos_normalizados`, `created`, `last_connection`) VALUES
(1, 1, 22, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(2, 1, 23, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(3, 1, 24, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(4, 1, 25, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(5, 1, 26, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(6, 1, 27, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(9, 1, 30, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(10, 1, 31, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(11, 1, 32, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(13, 1, 34, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(14, 1, 35, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(15, 1, 36, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(16, 1, 37, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(17, 1, 38, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(18, 1, 39, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(19, 1, 40, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(20, 1, 44, 3, 0, 0, '2016-07-06 13:00:47', NULL),
(21, 3, 60, 3, 0, 0, '2016-07-21 18:28:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `descripcion`, `level`) VALUES
(1, 'Administrador', 100),
(2, 'Profesor', 10),
(3, 'Alumno', 1),
(4, 'Director', 20);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `escuela_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `usuario_creador_id` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_usuarios_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `apellido`, `gender`, `rol_id`, `avatar_id`, `escuela_id`, `created`, `usuario_creador_id`, `modified`, `deleted`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Admin', 'male', 1, 1, NULL, NULL, 0, NULL, NULL),
(19, 'lbustos@enclave.com.ar', '05a671c66aefea124cc08b76ea6d30bb', 'Luciano', 'Bustos', 'male', 3, 1, NULL, NULL, 0, NULL, NULL),
(20, 'nskolaris@enclave.com.ar', '05a671c66aefea124cc08b76ea6d30bb', 'Nicolas ', 'Skolaris', 'male', 3, 1, NULL, NULL, 0, NULL, NULL),
(21, 'profesor@profesor.com', '793741d54b00253006453742ad4ed534', 'Profesor', 'Profesor', 'female', 2, 1, 1, NULL, 42, '2016-07-01 20:56:12', NULL),
(22, 's_gonzalez', '5ec450e193c3f61719885c50fd22fc4d', 'Santiago', 'González Breard', 'male', 3, 13, 1, NULL, 0, NULL, NULL),
(23, 'l_delpino', '64b64029dd74d3f1fc1a591a88f5bfc5', 'Lucía', 'Delpino', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(24, 't_manjak', 'c6ffe7491d0198dbe556b4cce816a9dd', 'Tomás', 'Manjak', 'male', 3, 1, 1, NULL, 0, NULL, NULL),
(25, 'v_teglia', 'a0da9532e54ed8338f85c71dac4b4397', 'Valentín', 'Teglia', 'male', 3, 2, 1, NULL, 0, '2016-05-18 14:28:51', NULL),
(26, 'v_maschi', 'ff4b52e2a5148317f0560f43a2fe0c80', 'Valentina', 'Maschi', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(27, 'a_cantero', '22dc21d3cd351421bfc1c5fe7f74fd56', 'Abril', 'Cantero', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(28, 'm_lozano', '9e0d025a5c8dc45726f218f057de9010', 'Micaela', 'Lozano', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(29, 'n_gonzalez', '4e12cb6c52d002082614a51bdc58acff', 'Nicolás', 'Gonzalez', 'male', 3, 1, 1, NULL, 0, NULL, NULL),
(30, 'jc_manjak', '2718666177f47957aadbd10d6290bb7d', 'Juan Cruz', 'Manjak', 'male', 3, 1, 1, NULL, 0, NULL, NULL),
(31, 'v_sarno', 'f781c270c4603a3c112b51b7df6df0fd', 'Valentina', 'Sarno', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(32, 's_zanelli', '835c97c47bc9e02f1ee4516b37045998', 'Sofía', 'Zanelli', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(33, 'c_gras', 'e97db139c91095126e02549933313499', 'Camila', 'Gras', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(34, 'j_moron', '27f3c0b68b41ef7d15a3be3e33b836fb', 'Joaquín', 'Morón', 'male', 3, 1, 1, NULL, 0, NULL, NULL),
(35, 'a_suarez', 'b7184d5c640efe842185d7a01c4c346c', 'Alejo', 'Suarez', 'male', 3, 1, 1, NULL, 0, NULL, NULL),
(36, 'j_rodriguez', 'ef2eeb69c6de44a32c345ea579617e87', 'Julieta', 'Rodríguez', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(37, 'a_molina', '573864e2900fb52c9a83aa0aa615b7ec', 'Abril', 'Molina', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(38, 'm_jara', 'aefc5962e9dde2126bcc15ce3e7881b8', 'Milagros', 'Jara', 'female', 3, 2, 1, NULL, 0, NULL, NULL),
(39, 'j_zimmerman', '673e31f36d1e379d4979b62ce2091282', 'Juan', 'Zimmerman', 'male', 3, 1, 1, NULL, 0, NULL, NULL),
(40, 'a_twaska', 'c01006bfc3fce9f32925e80801916d0f', 'Alexis', 'Twaska', 'male', 3, 1, 1, NULL, 0, NULL, NULL),
(41, 'facundo', '73b817090081cef1bca77232f4532c5d', 'Facundo', ' ', 'male', 3, 9, NULL, NULL, 0, NULL, NULL),
(42, 'director@director.com', '3d4e992d8d8a7d848724aa26ed7f4176', 'Director', 'Director', 'male', 4, 1, 2, NULL, 0, NULL, NULL),
(43, 'alumno@alumno.com', 'c3e08dd3b27a3fe5f48a8e6fdc5a4317', 'Alumno', 'Alumno', 'male', 3, 1, 1, '2016-04-08 19:26:11', 42, '2016-04-08 19:26:11', NULL),
(44, 'c_montenegro', 'c_montenegro', 'Candela', 'Montenegro', 'female', 3, 2, 1, '2016-06-14 00:00:00', 0, '2016-06-14 00:00:00', NULL),
(45, 'profesor1@profesor.com', '8b4d5c41f3e78b68b422516524e01dd6', 'Nombre', 'Apellido', 'male', 2, 1, 1, '2016-06-16 14:31:12', 42, '2016-06-16 14:31:12', NULL),
(46, 'r_rodriguez@gmail.com', '4e7f1e7b3c6b17d614c0ce18de4bbca7', 'Rocio', 'Rodriguez', 'female', 3, 2, 2, '2016-07-02 12:22:41', 42, '2016-07-02 12:31:03', NULL),
(47, 'l_acosta@gmail.com', 'a869801095d620779e56077f76b74b73', 'Luciana', 'Acosta', 'female', 3, 2, 2, '2016-07-02 12:23:11', 42, '2016-07-02 12:31:39', NULL),
(48, 's_wyroslaw@gmail.com', 'd909921b5ac6b2f3edd3713beaea35a4', 'Silvana', 'Wyroslaw', 'female', 3, 2, 2, '2016-07-02 12:23:47', 42, '2016-07-02 12:31:48', NULL),
(49, 'c_contrera@gmail.com', '07ed33d698fbe29af199ce2567cc7e9c', 'Cynthia', 'Contrera', 'female', 3, 2, 2, '2016-07-02 12:24:17', 42, '2016-07-02 12:31:56', NULL),
(50, 't_romano@gmail.com', '187bed6abcd81dadf5969d7edd74dbca', 'Teresa', 'Romano', 'female', 3, 2, 2, '2016-07-02 12:24:42', 42, '2016-07-02 12:32:04', NULL),
(51, 'a_yebra@gmail.com', 'f169d7905479a3c406392ec520098ead', 'Adriana', 'Yebra', 'female', 3, 2, 2, '2016-07-02 12:25:18', 42, '2016-07-02 12:32:11', NULL),
(52, 'mk_pennela@gmail.com', 'bf89da18f3496e66840c28adb0d1ecea', 'Mariela Karina', 'Pennella', 'female', 3, 2, 2, '2016-07-02 12:26:55', 42, '2016-07-02 12:32:19', NULL),
(53, 'f_nuno@gmail.com', 'c01c144877b6c6764af17a72d9faece3', 'Florencia', 'Nuño', 'female', 3, 2, 2, '2016-07-02 12:27:35', 42, '2016-07-02 12:32:26', NULL),
(54, 'mj_bisbano@gmail.com', 'a48ee8ccd1d70015d47d1608707e3dbd', 'Maria Jose', 'Bisbano', 'female', 3, 2, 2, '2016-07-02 12:28:14', 42, '2016-07-02 12:32:42', NULL),
(55, 's_geoffroy@gmail.com', 'fe6679b4489445c7fcdd8f81f7763247', 'Susana', 'Geoffroy', 'female', 3, 2, 2, '2016-07-02 12:28:48', 42, '2016-07-02 12:32:36', NULL),
(56, 'pedro_r@gmail.com', 'b6f1e1853a3319889c3fd17087c323f4', 'Pedro', 'R', 'male', 3, 1, 2, '2016-07-02 12:41:16', 42, '2016-07-02 12:41:16', NULL),
(57, 'trigo.juan@gmail.com', 'f70d1a09577b0d0c5c1082990a925c3a', 'Juan', 'Trigo', 'male', 3, 1, 2, '2016-07-02 12:45:04', 1, '2016-07-02 12:46:11', NULL),
(58, 'dora@gmail.com', '9aed0f1658601f736c76230a3fe1ca86', 'Dora', 'Escribano', 'female', 3, 2, 2, '2016-07-02 12:45:33', 42, '2016-07-02 12:45:33', NULL),
(60, 'lmarziano@enclave.com.ar', 'f956a4b5985ab0dca841b6ad36d52c06', 'Lucas', 'Marziano', 'male', 3, 1, 1, '2016-07-21 14:42:41', 1, '2016-07-22 17:34:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_logins`
--

CREATE TABLE IF NOT EXISTS `usuario_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `usuario_logins`
--

INSERT INTO `usuario_logins` (`id`, `usuario_id`, `created`) VALUES
(1, 1, '2016-06-14 14:28:09'),
(2, 42, '2016-06-14 14:28:25'),
(3, 1, '2016-06-14 14:29:28'),
(4, 1, '2016-06-15 13:31:22'),
(5, 1, '2016-06-16 14:19:08'),
(6, 42, '2016-06-16 14:30:03'),
(7, 1, '2016-06-24 15:44:59'),
(8, 42, '2016-06-24 15:45:14'),
(9, 21, '2016-06-24 15:45:43'),
(10, 42, '2016-06-24 15:45:58'),
(11, 42, '2016-06-24 15:50:34'),
(12, 42, '2016-06-24 15:56:25'),
(13, 1, '2016-06-24 16:18:30'),
(14, 42, '2016-06-24 17:36:00'),
(15, 42, '2016-06-27 12:40:37'),
(16, 21, '2016-06-27 12:41:01'),
(17, 1, '2016-06-27 13:02:00'),
(18, 42, '2016-06-27 13:13:49'),
(19, 42, '2016-06-27 13:32:46'),
(20, 1, '2016-06-27 14:37:58'),
(21, 1, '2016-06-28 19:02:25'),
(22, 1, '2016-07-01 20:51:31'),
(23, 42, '2016-07-01 20:53:14'),
(24, 1, '2016-07-02 12:17:56'),
(25, 42, '2016-07-02 12:30:08'),
(26, 21, '2016-07-02 12:42:08'),
(27, 42, '2016-07-02 12:44:14'),
(28, 1, '2016-07-02 12:45:45'),
(29, 21, '2016-07-02 12:46:27'),
(30, 42, '2016-07-02 12:48:09'),
(31, 21, '2016-07-02 12:48:42'),
(32, 1, '2016-07-06 12:42:19'),
(33, 21, '2016-07-06 12:59:58'),
(34, 1, '2016-07-06 13:43:02'),
(35, 1, '2016-07-18 14:55:37'),
(36, 1, '2016-07-21 14:32:45'),
(37, 1, '2016-07-21 14:33:05'),
(38, 1, '2016-07-21 14:40:25'),
(39, 1, '2016-07-21 14:40:32'),
(40, 1, '2016-07-21 14:41:11'),
(41, 1, '2016-07-21 14:44:22'),
(42, 1, '2016-07-21 14:46:40'),
(43, 1, '2016-07-21 16:27:52'),
(44, 1, '2016-07-21 18:23:01'),
(45, 1, '2016-07-21 18:45:42'),
(46, 1, '2016-07-21 18:50:32'),
(47, 1, '2016-07-22 14:39:59'),
(48, 1, '2016-07-22 14:51:27'),
(49, 1, '2016-07-22 14:53:18'),
(50, 1, '2016-07-22 14:53:19'),
(51, 1, '2016-07-22 14:53:19'),
(52, 1, '2016-07-22 14:53:23'),
(53, 1, '2016-07-22 16:13:34'),
(54, 1, '2016-07-22 16:20:29'),
(55, 1, '2016-07-22 17:32:35'),
(56, 1, '2016-07-22 17:51:01'),
(57, 1, '2016-07-22 18:06:01'),
(58, 1, '2016-07-22 18:58:51'),
(59, 1, '2016-07-25 13:25:06'),
(60, 1, '2016-07-25 19:09:19'),
(61, 1, '2016-07-26 16:44:25'),
(62, 1, '2016-07-26 16:45:48'),
(63, 1, '2016-07-26 17:51:26'),
(64, 1, '2016-07-26 17:53:26'),
(65, 1, '2016-07-27 14:37:59'),
(66, 1, '2016-07-27 14:39:10'),
(67, 1, '2016-07-27 17:45:31'),
(68, 1, '2016-07-28 13:50:10'),
(69, 1, '2016-07-28 14:08:00'),
(70, 1, '2016-07-29 14:11:17'),
(71, 1, '2016-07-29 14:58:32'),
(72, 1, '2016-07-29 15:10:52'),
(73, 1, '2016-07-29 15:48:42'),
(74, 1, '2016-07-29 17:59:14'),
(75, 1, '2016-07-29 18:23:59'),
(76, 1, '2016-08-01 13:25:33'),
(77, 1, '2016-08-04 18:56:24'),
(78, 1, '2016-08-18 17:23:10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
