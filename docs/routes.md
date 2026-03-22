# Routes Reference

## Public Routes (No Login Required)

| Method | URL | Description |
|---|---|---|
| GET | `/` | Home feed (For You / Following) |
| GET | `/?type=foryou` | For You personalized feed |
| GET | `/?type=following` | Following feed |
| GET | `/v/{video}` | Video detail page |
| GET | `/explore` | Explore video grid |
| GET | `/login` | Login page |
| POST | `/login` | Process login |
| GET | `/signup` | Registration page |
| POST | `/signup` | Process registration |
| GET | `/profile/@{username}` | Public user profile |
| GET | `/live` | Live streams index |

---

## Authenticated Routes (Login Required)

### Profile & Settings
| Method | URL | Description |
|---|---|---|
| GET | `/profile` | My profile |
| GET | `/profile/edit` | Edit profile form |
| POST | `/profile/update` | Save profile changes |
| GET | `/settings` | Settings page |
| POST | `/settings/update` | Save settings (language, location, dark mode, etc.) |

### Content Creation
| Method | URL | Description |
|---|---|---|
| GET | `/upload` | Upload video form |
| POST | `/v/upload` | Submit video upload |

### Live Streaming
| Method | URL | Description |
|---|---|---|
| GET | `/live/create` | Create live stream form |
| POST | `/live` | Start live stream |
| GET | `/live/{session}` | Watch a live stream |
| POST | `/live/{session}/message` | Send chat message |
| POST | `/live/{session}/like` | Like a stream |
| GET | `/live/{session}/sync` | Poll for new data |
| POST | `/live/{session}/end` | End the stream |

### Social Interactions
| Method | URL | Description |
|---|---|---|
| POST | `/videos/{video}/like` | Toggle like |
| POST | `/videos/{video}/comment` | Post a comment |
| GET | `/videos/{video}/comments` | Get comments |
| POST | `/videos/{video}/repost` | Toggle repost |
| POST | `/videos/{video}/share` | Share video |
| POST | `/videos/{video}/bookmark` | Toggle bookmark |
| POST | `/users/{user}/follow` | Toggle follow |
| GET | `/following` | Following feed page |
| GET | `/friends` | Mutual follows (friends) |

### Messaging
| Method | URL | Description |
|---|---|---|
| GET | `/messages` | Messages inbox |
| GET | `/api/messages/{user}` | Get conversation with user |
| POST | `/api/messages/{user}` | Send a message |

### Notifications
| Method | URL | Description |
|---|---|---|
| GET | `/notifications` | Notifications list |

### Shop
| Method | URL | Description |
|---|---|---|
| GET | `/shop` | Product listing |
| GET | `/shop/product/{product}` | Product detail |
| GET | `/shop/cart` | Shopping cart |
| POST | `/shop/cart` | Add to cart |
| PUT | `/shop/cart/{cartItem}` | Update cart item |
| DELETE | `/shop/cart/{cartItem}` | Remove from cart |
| GET | `/shop/checkout` | Checkout page |
| GET | `/shop/orders` | Order history |
| GET | `/shop/seller` | Seller dashboard |
| GET | `/shop/addresses` | Delivery addresses |
| POST | `/shop/addresses` | Add address |
| GET | `/shop/payments` | Payment methods |
| POST | `/shop/payments` | Add payment method |

### Wallet & Discovery
| Method | URL | Description |
|---|---|---|
| GET | `/wallet` | Coin wallet |
| GET | `/search` | Search page |

### Info Pages
| Method | URL | Description |
|---|---|---|
| GET | `/privacy` | Privacy Center |
| GET | `/safety` | Safety Center |
| GET | `/guidelines` | Community Guidelines |
| GET | `/help` | Help Center |
| GET | `/activity` | Watch history |
| GET | `/preferences` | Content preferences |
| POST | `/logout` | Log out |
