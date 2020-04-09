drop table eventos;

drop table palabrasprohibidas;

drop table comentario;

create table eventos (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255),
    organizador VARCHAR(100),
    fecha DATE,
    descripcion TEXT,
    fotos TEXT
);

create table palabrasprohibidas(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    palabra VARCHAR(45)
);

create table comentario(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    autor VARCHAR(30),
    fecha DATE,
    comentario TEXT,
    email VARCHAR(100)
);

INSERT INTO
    SIBW.eventos (nombre, organizador, fecha, descripcion, fotos)
VALUES
    (
        "Concierto musica clasica",
        "Ayuntamiento de granada",
        "2020-09-21",
        "EVENTO 1 TEXTO DE EJEMPLO: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel justo id velit tempus bibendum. In sollicitudin nibh vitae ipsum gravida imperdiet. Proin mollis tempus velit, quis dignissim turpis ultricies sed. Nunc augue lacus, egestas a enim vitae, facilisis semper risus. Aliquam urna odio, posuere nec sagittis at, bibendum pretium eros. Etiam leo urna, porttitor et metus nec, consequat mollis neque. Cras elementum risus vel lacus dignissim, nec eleifend massa mattis. Nunc scelerisque purus ac tellus ultricies rhoncus. Curabitur luctus laoreet erat vitae dignissim. Phasellus dui elit, posuere non odio et, rhoncus rhoncus elit. Nullam dapibus porttitor felis quis pulvinar. Nullam suscipit ultricies nulla, sed condimentum massa iaculis sed.
Sed dapibus nec lacus sit amet vulputate. Phasellus lobortis elementum justo vitae suscipit. Pellentesque eleifend congue nisl a consequat. Nunc sollicitudin eros tellus, in dapibus turpis dignissim a. Vestibulum id feugiat purus, nec tincidunt purus. Morbi fringilla porta mi quis interdum. Duis consequat augue a odio molestie eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec neque nunc, tempor ut aliquam nec, tempor eu sem. Morbi at nisl bibendum, tristique dolor vel, auctor metus. Nullam ut lobortis enim.
Donec id Donec id Donec id porttitor est.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget finibus dolor, nec dignissim odio. Maecenas dignissim urna felis, sit amet luctus nibh convallis a. Proin nec eros pretium mauris vulputate venenatis. Cras sapien nisl, pellentesque eu rhoncus in, tempus sed libero. Etiam vel vehicula mauris, eget tincidunt odio. Donec semper quam eu sem venenatis mattis. In at maximus augue. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas quis malesuada odio. Donec condimentum tellus vitae mi vestibulum sagittis. Sed vulputate tortor at turpis vulputate elementum. Donec felis sem, commodo vitae dignissim sit amet, condimentum id nulla. Ut at nisl porta, mattis arcu ultricies, porta augue. Quisque venenatis, ex at efficitur varius, ante lacus volutpat lorem, quis eleifend neque ex vel odio.",
        "/img/img1.png:/img/img2.png"
    );

INSERT INTO
    SIBW.eventos (nombre, organizador, fecha, descripcion, fotos)
VALUES
    (
        "Concierto musica rock",
        "Bar la puerta",
        "2020-08-21",
        "EVENTO 2 TEXTO DE EJEMPLO: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel justo id velit tempus bibendum. In sollicitudin nibh vitae ipsum gravida imperdiet. Proin mollis tempus velit, quis dignissim turpis ultricies sed. Nunc augue lacus, egestas a enim vitae, facilisis semper risus. Aliquam urna odio, posuere nec sagittis at, bibendum pretium eros. Etiam leo urna, porttitor et metus nec, consequat mollis neque. Cras elementum risus vel lacus dignissim, nec eleifend massa mattis. Nunc scelerisque purus ac tellus ultricies rhoncus. Curabitur luctus laoreet erat vitae dignissim. Phasellus dui elit, posuere non odio et, rhoncus rhoncus elit. Nullam dapibus porttitor felis quis pulvinar. Nullam suscipit ultricies nulla, sed condimentum massa iaculis sed.
Sed dapibus nec lacus sit amet vulputate. Phasellus lobortis elementum justo vitae suscipit. Pellentesque eleifend congue nisl a consequat. Nunc sollicitudin eros tellus, in dapibus turpis dignissim a. Vestibulum id feugiat purus, nec tincidunt purus. Morbi fringilla porta mi quis interdum. Duis consequat augue a odio molestie eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec neque nunc, tempor ut aliquam nec, tempor eu sem. Morbi at nisl bibendum, tristique dolor vel, auctor metus. Nullam ut lobortis enim.
Donec id porttitor est.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget finibus dolor, nec dignissim odio. Maecenas dignissim urna felis, sit amet luctus nibh convallis a. Proin nec eros pretium mauris vulputate venenatis. Cras sapien nisl, pellentesque eu rhoncus in, tempus sed libero. Etiam vel vehicula mauris, eget tincidunt odio. Donec semper quam eu sem venenatis mattis. In at maximus augue. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas quis malesuada odio. Donec condimentum tellus vitae mi vestibulum sagittis. Sed vulputate tortor at turpis vulputate elementum. Donec felis sem, commodo vitae dignissim sit amet, condimentum id nulla. Ut at nisl porta, mattis arcu ultricies, porta augue. Quisque venenatis, ex at efficitur varius, ante lacus volutpat lorem, quis eleifend neque ex vel odio.",
        "/img/img2.png:/img/img1.png"
    );

INSERT INTO
    SIBW.eventos (nombre, organizador, fecha, descripcion, fotos)
VALUES
    (
        "Concierto musica trap",
        "Asociacion de vecinos",
        "2020-11-10",
        "EVENTO 3 TEXTO DE EJEMPLO: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel justo id velit tempus bibendum. In sollicitudin nibh vitae ipsum gravida imperdiet. Proin mollis tempus velit, quis dignissim turpis ultricies sed. Nunc augue lacus, egestas a enim vitae, facilisis semper risus. Aliquam urna odio, posuere nec sagittis at, bibendum pretium eros. Etiam leo urna, porttitor et metus nec, consequat mollis neque. Cras elementum risus vel lacus dignissim, nec eleifend massa mattis. Nunc scelerisque purus ac tellus ultricies rhoncus. Curabitur luctus laoreet erat vitae dignissim. Phasellus dui elit, posuere non odio et, rhoncus rhoncus elit. Nullam dapibus porttitor felis quis pulvinar. Nullam suscipit ultricies nulla, sed condimentum massa iaculis sed.
Sed dapibus nec lacus sit amet vulputate. Phasellus lobortis elementum justo vitae suscipit. Pellentesque eleifend congue nisl a consequat. Nunc sollicitudin eros tellus, in dapibus turpis dignissim a. Vestibulum id feugiat purus, nec tincidunt purus. Morbi fringilla porta mi quis interdum. Duis consequat augue a odio molestie eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec neque nunc, tempor ut aliquam nec, tempor eu sem. Morbi at nisl bibendum, tristique dolor vel, auctor metus. Nullam ut lobortis enim.
Donec id porttitor est.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget finibus dolor, nec dignissim odio. Maecenas dignissim urna felis, sit amet luctus nibh convallis a. Proin nec eros pretium mauris vulputate venenatis. Cras sapien nisl, pellentesque eu rhoncus in, tempus sed libero. Etiam vel vehicula mauris, eget tincidunt odio. Donec semper quam eu sem venenatis mattis. In at maximus augue. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas quis malesuada odio. Donec condimentum tellus vitae mi vestibulum sagittis. Sed vulputate tortor at turpis vulputate elementum. Donec felis sem, commodo vitae dignissim sit amet, condimentum id nulla. Ut at nisl porta, mattis arcu ultricies, porta augue. Quisque venenatis, ex at efficitur varius, ante lacus volutpat lorem, quis eleifend neque ex vel odio.",
        "/img/img3.png:/img/img2.png"
    );

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("covid");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("corona");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("virus");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("gripe");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("flu");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("mascarilla");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("papel");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("higienico");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("mercadona");

INSERT INTO
    SIBW.palabrasprohibidas (palabra)
VALUES
    ("aplauso");

INSERT INTO
    SIBW.comentario(autor, comentario, email, fecha)
VALUES
    (
        "covid-20",
        "Increible estos eventos",
        "covid-19@flu.com",
        NOW()
    );

INSERT INTO
    SIBW.comentario(autor, comentario, email, fecha)
VALUES
    (
        "grip-esp",
        "El evento de 1918 fue mejor",
        "gripe-española@flu.com",
        NOW()
    );