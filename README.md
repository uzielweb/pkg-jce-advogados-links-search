# Pacote Advogados Plugins para Joomla

[![Joomla Version](https://img.shields.io/badge/Joomla-4.x%20%7C%205.x-blue.svg)](https://www.joomla.org)
[![License](https://img.shields.io/badge/License-GNU%2FGPL-green.svg)](https://www.gnu.org/licenses/gpl.html)
[![Version](https://img.shields.io/badge/version-1.0.0-orange.svg)](https://github.com/uzielweb/pkg-jce-advogados-links-search)

## Descrição

Pacote completo de plugins Joomla para integração do componente Advogados com o editor JCE e sistema de busca nativo do Joomla.

### Plugins Incluídos

1. **Plugin JCE Links Advogados** (`plg_jce_linksadvogados`)
   - Integração com o editor JCE
   - Links diretos para perfis de advogados no navegador de links do JCE
   - Busca e navegação de advogados dentro do editor

2. **Plugin Search Advogados** (`plg_search_advogados`)
   - Integração com o sistema de busca do Joomla
   - Busca em nomes, especializações e biografias
   - Resultados diretos para perfis de advogados

## Características

- 📦 Instalação única de múltiplos plugins
- 🔗 Integração completa com JCE Editor
- 🔍 Sistema de busca nativo do Joomla
- 🌍 Suporte multilíngue (pt-BR e en-GB)
- 🔄 Atualizações automáticas
- ⚡ Fácil instalação e configuração

## Requisitos

- Joomla 4.0 ou superior
- PHP 7.4 ou superior
- Componente Advogados (com_advogados)
- Editor JCE (para o plugin de links)

## Instalação

1. Faça o download da última versão do pacote
2. No painel administrativo do Joomla, navegue até **Sistema → Extensões → Instalar**
3. Arraste o arquivo ZIP ou navegue até ele
4. O pacote instalará automaticamente ambos os plugins
5. Após a instalação, vá em **Sistema → Gerenciar → Plugins**
6. Ative os plugins:
   - **JCE - Links de Advogados**
   - **Busca - Advogados**

## Configuração

### Plugin JCE Links Advogados

1. Certifique-se de que o editor JCE está instalado e ativado
2. O plugin funcionará automaticamente após a ativação
3. No editor JCE, clique no botão de link para ver a opção "Advogados"

### Plugin Search Advogados

1. Vá em **Sistema → Gerenciar → Plugins**
2. Procure por "Busca - Advogados" e edite
3. Configure as opções:
   - **Buscar Conteúdo**: Incluir biografias na busca
   - **Buscar Arquivados**: Incluir advogados arquivados
   - **Limite de Busca**: Número máximo de resultados (padrão: 50)

## Estrutura do Pacote

```
pkg-jce-advogados-links-search/
├── pkg_jce_advogados.xml           # Manifesto do pacote
├── script.php                      # Script de instalação
├── README.md                       # Este arquivo
├── CHANGELOG.md                    # Histórico de alterações
├── build.sh                        # Script de build
├── language/                       # Arquivos de idioma do pacote
│   ├── en-GB/
│   │   ├── pkg_jce_advogados.ini
│   │   └── pkg_jce_advogados.sys.ini
│   └── pt-BR/
│       ├── pkg_jce_advogados.ini
│       └── pkg_jce_advogados.sys.ini
├── plg_jce_linksadvogados/        # Plugin JCE Links
│   ├── plg_jce_linksadvogados.php
│   ├── plg_jce_linksadvogados.xml
│   └── language/
│       ├── en-GB/
│       └── pt-BR/
└── plg_search_advogados/          # Plugin Search
    ├── plg_search_advogados.php
    ├── plg_search_advogados.xml
    └── language/
        ├── en-GB/
        └── pt-BR/
```

## Uso

### JCE Links

1. No editor JCE, clique no botão de link (corrente)
2. No navegador de links, você verá a opção "Advogados"
3. Navegue ou busque pelo advogado desejado
4. Selecione o advogado para inserir o link

### Busca

1. Use o módulo de busca do Joomla no frontend
2. Digite o nome ou especialização do advogado
3. Os resultados incluirão perfis de advogados correspondentes
4. Clique no resultado para ir ao perfil

## Desenvolvimento

### Clonar o Repositório

```bash
git clone https://github.com/uzielweb/pkg-jce-advogados-links-search.git
cd pkg-jce-advogados-links-search
```

### Build do Pacote

```bash
chmod +x build.sh
./build.sh
```

Isso criará um arquivo `pkg_jce_advogados_v1.0.0.zip` pronto para instalação.

### Contribuindo

Contribuições são bem-vindas! Por favor:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

## Changelog

Veja o arquivo [CHANGELOG.md](CHANGELOG.md) para histórico detalhado de versões.

## Licença

Este projeto está licenciado sob a GNU/GPL License - veja os detalhes em [GNU General Public License](https://www.gnu.org/licenses/gpl.html).

## Autor

**Ponto Mega**

- GitHub: [@uzielweb](https://github.com/uzielweb)

## Suporte

Para suporte, questões ou sugestões:

- Abra uma [issue](https://github.com/uzielweb/pkg-jce-advogados-links-search/issues) no GitHub
- Entre em contato através do repositório

## Plugins Individuais

Se preferir, cada plugin também está disponível separadamente:

- [Plugin JCE Links Advogados](https://github.com/uzielweb/plg_jce_links_advogados)
- Plugin Search Advogados (em breve)

## Agradecimentos

- Comunidade Joomla
- Desenvolvedores do JCE Editor
- Todos os contribuidores

---

Desenvolvido com ❤️ para a comunidade Joomla
