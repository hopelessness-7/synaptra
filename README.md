# 🚀 Synaptra — AI-усиленное пространство для разработки

**Synaptra** — это платформа нового поколения, объединяющая функциональность Trello, Jira, Git и Miro с интеллектуальными возможностями AI. Наша цель — устранить менеджерскую рутину и создать среду, где разработчики могут сосредоточиться на коде, а AI берёт на себя распределение задач, контроль прогресса и отчётность.

---

<details>
<summary>🇷🇺 Читать описание на русском</summary>

## 💡 Ключевая идея

Synaptra заменяет традиционную цепочку "менеджер → тимлид → разработчик" на AI-ассистента, который:

- 📌 Понимает задачи от менеджеров.
- 🧠 Автоматически распределяет их между разработчиками.
- 🔍 Анализирует коммиты и pull requests.
- 📊 Контролирует выполнение задач и формирует отчёты.
- 🤖 В будущем: участвует в code review, помогает в CI/CD, генерирует документацию.

> ⚠️ **Важно:** Synaptra **не заменяет тимлида**, а усиливает его. AI-ассистент берёт на себя рутину, позволяя тимлиду сосредоточиться на архитектуре, росте команды и стратегических решениях. Это облегчает коммуникацию, делает процесс постановки задач и контроля более прозрачным и понятным для всей команды.

---

## 🔐 Безопасность и развертывание

Synaptra поставляется как **коробочное решение**, которое можно развернуть на внутреннем сервере компании. Это обеспечивает:

- 🔒 Полный контроль над данными.
- 🌐 Работа без зависимости от внешних облаков.
- 🛡 Соответствие внутренним политикам безопасности.

---

## 🧩 Модули и структура

### ✅ Реализовано:
- **Auth** — JWT-аутентификация, история входов, подтверждение устройств.
- **Project** — управление проектами и командами.
- **Kanban** — визуальная доска задач с поддержкой гибкого workflow.

### 🆕 Новый интерфейс:
- Страница авторизации и регистрации
- Главный дашборд
- Онбординг для быстрого старта в проекте

### 🔄 В процессе:
- **Git Integration (MVP)** — webhooks для GitHub/GitLab, анализ коммитов.
- **AI-ассистент** — интеллектуальное распределение и мониторинг задач.

---

## 🧠 Что умеет AI

> **Synaptra AI** = виртуальный тимлид.

- ⚙️ Назначает задачи с учётом навыков, загрузки и контекста.
- 🧾 Генерирует отчёты и статус обновления.
- 📎 Связывает задачи с коммитами.
- 🗂 Предлагает улучшения в декомпозиции задач.
- 🤝 Поддерживает команду как цифровой помощник.

---

## 🛠 Стек технологий

- **Backend**: Laravel 12, модульная архитектура (DDD-inspired)
- **Frontend**: Blade (SSR, без SPA в MVP)
- **Язык**: PHP 8.3+
- **Инфраструктура контейнеров (Laravel Sail)**:
    - Docker с базовой конфигурацией
    - Контейнеры: `soketi` (WebSocket сервер), `redis`, `mysql`, `elasticsearch`
- **Git-интеграция**: Webhooks (GitHub/GitLab)
- **AI**: NLP, ML (в будущем — LLM и embedding store)

> 🔧 В планах — пересмотр и оптимизация Docker-структуры для более гибкого масштабирования и расширения функционала. Будет создан не базовый Sail `docker-compose.yml`, а более чётко разделённая и улучшенная структура контейнеров.


## 📁 Архитектура проекта (пример модуля)

```
Modules/
└── Auth/
    ├── Application/
    ├── Domain/
    ├── Http/
    └── Infrastructure/
```

> Принцип разделения: Application (UseCases, DTO) / Domain (Entities, Contracts) / Infrastructure (Eloquent, сервисы, миграции) / Http (контроллеры, middleware, requests, ресурсы)

---

## 🛣 Roadmap

| Версия | Особенности |
|--------|-------------|
| MVP    | Auth + Project + Kanban + Git (через webhook) |
| v1.1   | AI-ассистент, анализ задач и активности |
| v2     | Микросервисная архитектура, CI/CD |
| v3     | Визуальное управление (Miro-style), собственное git-хранилище |

---

## 🌟 Почему Synaptra?

- ⏱ Меньше времени на менеджмент — больше на код.
- 🤖 Интеллектуальный ассистент вместо ручного контроля.
- 🧠 AI-помощник, обучаемый под команду.
- 🌐 Единая экосистема без разрозненных сервисов.
- 🧩 Поддержка локального развёртывания для максимальной безопасности.

---

## 🧾 Текущие коммиты

| Имя  | Ветка  | Описание                                                                        | Статус     |
|------|--------|---------------------------------------------------------------------------------|------------|
| SA01 | `sa01` | Полностью реализован Onboarding                                                 | Завершено  |
| SA02 | `sa02` | Реализован модуль AccessControl, отвечающий за управление ролями и разрешениями | Завершено  |

> 📌 **Формат названия веток:** `SAxx`, где `SA` — от *Synaptra*, а `xx` — номер задачи. Таблица фиксирует два завершённых коммита и один текущий в работе, чтобы наглядно отслеживать прогресс.

---

## 📬 Контакты

Создатель: [Egor Titov](mailto:titov.ggg2017@yandex.ru)

</details>

---

<details>
<summary>🇬🇧 Read in English</summary>

## 💡 Core Idea

Synaptra replaces the traditional chain “manager → tech lead → developer” with an AI assistant that:

- 📌 Understands tasks from managers.
- 🧠 Automatically distributes them among developers.
- 🔍 Analyzes commits and pull requests.
- 📊 Tracks progress and generates reports.
- 🤖 Future goals: code reviews, CI/CD help, and automatic documentation.

> ⚠️ **Note:** Synaptra **does not replace tech leads** — it empowers them. The AI handles repetitive tasks so that tech leads can focus on architecture, team development, and strategic planning. It improves communication, transparency, and task management across the team.

---

## 🔐 Security & Deployment

Synaptra is available as an **on-premise box solution**, which can be deployed on the client’s internal servers for:

- 🔒 Full data control.
- 🌐 Operation without third-party cloud dependencies.
- 🛡 Compliance with internal security policies.

---

## 🧩 Modules & Structure

### ✅ Implemented:
- **Auth** — JWT authentication, login history, device confirmations.
- **Project** — project and team management.
- **Kanban** — visual task board with flexible workflows.

### 🆕 UI Added:
- Login and registration screens
- Main dashboard
- Onboarding for quick project setup

### 🔄 In Progress:
- **Git Integration (MVP)** — webhooks for GitHub/GitLab, commit analysis.
- **AI Assistant** — intelligent task allocation and monitoring.

---

## 🧠 What Synaptra AI Can Do

> **Synaptra AI** = your virtual tech lead.

- ⚙️ Assigns tasks based on skills, workload, and context.
- 🧾 Generates reports and status updates.
- 📎 Links tasks to commits.
- 🗂 Suggests better task decomposition.
- 🤝 Supports the team as a digital assistant.

---

## 🛠  Tech Stack

- **Backend**: Laravel 12, modular architecture (DDD-inspired)
- **Frontend**: Blade (SSR, no SPA in MVP)
- **Language**: PHP 8.3+
- **Container Infrastructure (Laravel Sail)**:
    - Docker with basic configuration
    - Containers: `soketi` (WebSocket server), `redis`, `mysql`, `elasticsearch`
- **Git Integration**: Webhooks (GitHub/GitLab)
- **AI**: NLP, ML (future — LLM and embedding store)

> 🔧 Planned revision and optimization of the Docker setup for better scalability and extended functionality. Instead of the basic Sail `docker-compose.yml`, a more clearly separated and improved container structure will be created.

## 📁 Project Architecture (Module Example)

```
Modules/
└── Auth/
    ├── Application/
    ├── Domain/
    ├── Http/
    └── Infrastructure/
```

> Separation principles: Application (UseCases, DTOs) / Domain (Entities, Contracts) / Infrastructure (Eloquent, services, migrations) / Http (controllers, middleware, requests, resources)

---

## 🛣 Roadmap

| Version | Features |
|---------|----------|
| MVP     | Auth + Project + Kanban + Git (via webhook) |
| v1.1    | AI assistant, task and activity analysis |
| v2      | Microservices architecture, CI/CD |
| v3      | Visual planning (Miro-style), own Git storage |

---

## 🌟 Why Synaptra?

- ⏱ Less time on management — more time for code.
- 🤖 Smart assistant instead of manual control.
- 🧠 AI tailored to your team.
- 🌐 Unified ecosystem without scattered tools.
- 🧩 On-prem deployment for full control and security.

---

## 🧾 Commit Activity

| Name | Branch | Commit Description                                                   | Status      |
|------|--------|----------------------------------------------------------------------|-------------|
| SA01 | `sa01` | Fully implemented Onboarding                                         | Completed   |
| SA02 | `sa02` | Introduced AccessControl module to handle user roles and permissions | Completed   |

> 📌 **Branch name format:** `SAxx`, where `SA` stands for Synaptra and `xx` is the task number. The table shows two recent closed commits and the current one in progress to track development progress clearly.

---

## 📬 Contact

Creator: [Egor Titov](mailto:titov.ggg2017@yandex.ru)

</details>

