# Test Coverage Analysis — AbbysFramework

## Current State

**The project has zero automated tests.** There are no test files, no test framework (e.g. PHPUnit) configured, and no `composer.json` to manage dependencies. The only test-related file is `echotest.php`, which simply echoes output and is not a real test.

---

## Framework Components and Recommended Test Coverage

### 1. Router (`system/routing/router.php`) — **HIGH PRIORITY**

The `Router` class is responsible for parsing incoming URLs into application/controller/method/var segments and falling back to defaults. This is the backbone of the framework.

**What to test:**
- `parseURL()` correctly splits a URL into `application`, `controller`, `method`, and `var`
- Default controller/method fallback when segments are missing
- `cleanUri()` sanitizes each URI segment
- `curPageURL()` handles HTTPS and non-standard ports
- Edge cases: empty URLs, URLs with extra slashes, URLs with special characters

**Why:** A bug here silently routes users to wrong controllers or produces 404s. URL parsing is easy to unit test with no database dependency.

---

### 2. Validator / Form (`system/db/validator.php`, `system/db/form.php`) — **HIGH PRIORITY**

The `Validator` class has methods `checkEmpty`, `checkPassword`, `checkEqual`, and `checkEmail`. The `Form` class manages a list of validators and runs them against model fields.

**What to test:**
- `checkEmpty()` adds error message when field is empty, stays silent when filled
- `checkPassword()` detects mismatched passwords and empty passwords
- `checkEqual()` detects inequality and empty values
- `checkEmail()` — currently always returns `ERROR_MAIL` (this is a bug worth catching)
- `Form::setValidator()` and `getValidators()` correctly register and retrieve validators
- End-to-end: `Model::isValid()` wires validators to model fields correctly

**Why:** Validation logic is pure and has no external dependencies — ideal for unit testing. The `checkEmail()` function appears broken (always returns an error), which a test would immediately reveal.

---

### 3. Model (`system/db/model.php`) — **HIGH PRIORITY**

The base `Model` class provides `prepareStatement()`, `getInstance()`, and `isValid()`.

**What to test:**
- `prepareStatement()` correctly substitutes named `:param` placeholders with escaped values
- `prepareStatement()` handles multiple parameters, special characters, and empty params
- `getInstance()` returns all class properties as a dictionary
- `isValid()` runs all registered validators and returns `true`/`false` correctly

**Why:** `prepareStatement()` is the query builder used by every model. Incorrect substitution can cause SQL errors or — critically — **SQL injection** (see Security section below).

---

### 4. HttpHandler (`system/httphandler.php`) — **MEDIUM PRIORITY**

Handles HTTP input sanitization, request method detection, and POST-to-object mapping.

**What to test:**
- `cleanVar()` strips slashes and escapes dangerous characters
- `wipe()` sanitizes input correctly
- `isPost()` / `isGet()` detect request methods
- `redirect()` constructs the correct redirect URL
- `mapPost()` maps POST data to object properties

**Why:** This is the boundary between user input and the application. Testing sanitization functions ensures XSS and injection defenses work.

---

### 5. SessionMan (`system/sessionman.php`) — **MEDIUM PRIORITY**

Manages PHP sessions (get, set, delete, init).

**What to test:**
- `setSessionValue()` stores values retrievable by `getSessionValue()`
- `deleteSessionValue()` removes the key
- `getSessionValue()` for a non-existent key (currently no guard — potential PHP notice)
- `initSession()` sets the session name correctly

**Why:** Session management underpins authentication. The `getSessionValue()` method accesses `$_SESSION[$key]` without checking `isset()` first — a test would catch this.

---

### 6. FileManager (`system/filemanager.php`) — **MEDIUM PRIORITY**

Loads controllers, models, and views by constructing file paths, and handles file uploads.

**What to test:**
- `loadController()` falls back to the error controller when the file doesn't exist
- `loadModel()` does nothing (silently) for non-existent files
- `loadView()` falls back to the default error view for missing view files
- `loadFile()` validates file type and size, detects duplicate uploads, and handles upload errors

**Why:** Path construction bugs lead to white screens. The file upload function has multiple branches that should all be tested.

---

### 7. Application (base class) (`system/base.php`) — **MEDIUM PRIORITY**

The main `Application` class that ties routing, auth, and controller loading together.

**What to test:**
- `setUri()` correctly initializes URI properties from the Router
- `loadController()` invokes the correct method on the resolved controller
- `loadController()` falls back to error controller when method doesn't exist
- `checkSystem()` disables DB-dependent features when the database is unreachable
- `checkAuth()` redirects unauthenticated users to the login controller

**Why:** Integration tests here validate the entire request lifecycle.

---

### 8. Driver / DB Connections (`system/db/driver.php`, `system/db/dbcon.php`, `system/db/pgdbcon.php`) — **LOW PRIORITY (integration tests)**

**What to test:**
- `Driver` selects the correct engine based on `DB_DRIVER` constant
- `MySQLDBConnection::doQuery()` returns results as an associative array
- `PgDBConnection::doQuery()` returns results as an associative array
- Both `checkDB()` methods return `false` on connection failure

**Why:** These require a database to test meaningfully (integration tests), but they're important for confidence in deployments.

---

### 9. Login Controller (`application/backend/login/controller/login.php`) — **MEDIUM PRIORITY**

**What to test:**
- `access()` authenticates valid credentials and sets session
- `access()` rejects invalid credentials and shows error view
- `logout()` destroys the session
- `checkGlobalAccess()` redirects admin users vs. vendor users to different dashboards

**Why:** The authentication flow is security-critical. Testing it prevents regressions that could lock users out or allow unauthorized access.

---

### 10. Mailer (`system/mailer.php`) — **LOW PRIORITY**

**What to test:**
- `loadTemplate()` reads a template file
- `prepareTemplate()` substitutes placeholders with data
- `includeList()` generates correct HTML list markup
- `prepareDetails()` formats reservation data into HTML

**Why:** Template preparation is pure string manipulation — easy to test. Actual email sending can be mocked.

---

## Security Vulnerabilities That Tests Would Catch

The codebase has several security concerns that automated tests would help surface:

| Issue | Location | Severity |
|---|---|---|
| **`mysql_escape_string()` usage** (deprecated, no connection context) | `router.php:79`, `httphandler.php:11,12,44,45,102`, `model.php:64` | **Critical** |
| **SQL injection via `prepareStatement()`** — string replacement is not true parameterized queries | `model.php:56-76` | **Critical** |
| **MD5 password hashing** (weak, unsalted) | `login.php:27`, `model_usuario.php:46,71` | **High** |
| **`checkEmail()` always returns error** (never validates) | `validator.php:17-25` | **Medium** |
| **`getSessionValue()` no `isset()` check** — PHP notice on missing key | `sessionman.php:9` | **Low** |
| **Open redirect in `HttpHandler::redirect()`** — no URL validation | `httphandler.php:53-57` | **Medium** |

---

## Recommended Implementation Plan

### Phase 1: Set up testing infrastructure
1. Initialize Composer (`composer init`)
2. Add PHPUnit as a dev dependency (`composer require --dev phpunit/phpunit`)
3. Create `phpunit.xml` configuration
4. Create a `tests/` directory structure mirroring `system/`

### Phase 2: Unit tests for pure logic (no DB, no session)
- `tests/system/routing/RouterTest.php` — URL parsing and sanitization
- `tests/system/db/ValidatorTest.php` — all validation methods
- `tests/system/db/FormTest.php` — validator registration
- `tests/system/db/ModelTest.php` — `prepareStatement()`, `getInstance()`, `isValid()`
- `tests/system/MailerTest.php` — template loading and preparation

### Phase 3: Tests requiring superglobal mocking
- `tests/system/HttpHandlerTest.php` — input sanitization and request detection
- `tests/system/SessionManTest.php` — session operations
- `tests/system/AuthTest.php` — authentication check

### Phase 4: Integration tests
- `tests/system/ApplicationTest.php` — full request lifecycle
- `tests/application/backend/login/LoginTest.php` — authentication flow
- `tests/system/db/DriverTest.php` — database connectivity (requires test DB)
- `tests/system/FileManagerTest.php` — file loading and upload handling

---

## Summary

| Priority | Component | Test Type | Estimated Tests |
|---|---|---|---|
| HIGH | Router | Unit | 8-10 |
| HIGH | Validator / Form | Unit | 10-12 |
| HIGH | Model (`prepareStatement`, `isValid`) | Unit | 8-10 |
| MEDIUM | HttpHandler | Unit | 8-10 |
| MEDIUM | SessionMan | Unit | 5-6 |
| MEDIUM | FileManager | Unit + Integration | 6-8 |
| MEDIUM | Application (base) | Integration | 5-7 |
| MEDIUM | Login Controller | Integration | 5-6 |
| LOW | Mailer | Unit | 4-5 |
| LOW | DB Driver/Connections | Integration | 4-5 |
| **Total** | | | **~63-79** |

Starting with **Phase 1 + Phase 2** would provide immediate value — covering the most critical, easiest-to-test components (Router, Validator, Model) with no external dependencies required.
