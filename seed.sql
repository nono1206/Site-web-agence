

USE mini_site;

INSERT INTO services (titre, description, image) VALUES
('Création de site web', 'Sites vitrines modernes et responsives.', NULL),
('Hébergement', 'Hébergement sécurisé avec sauvegardes.', NULL),
('Maintenance', 'Mises à jour et support technique.', NULL);

INSERT INTO users (username, password_hash, role) VALUES
('admin', '$2y$10$6MxWu3krKxXvpPMA0x7J5uhOQ2VCDxUb6VBLdJfGEUxxSawLfVanO', 'admin');