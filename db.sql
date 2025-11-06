CREATE TABLE IF NOT EXISTS itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- ALTER exemplo: adiciona uma nova coluna
ALTER TABLE itens ADD COLUMN descricao TEXT;
