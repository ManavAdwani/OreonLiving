# Application Flows — Oreon Living

## 1. High-Level Customer Journey

```mermaid
flowchart TD
    A[Visitor Lands on Homepage] --> B{Explore Catalog}
    B -->|Browse by Category| C[Category Page /shop/category]
    B -->|Search Products| D[Search Results /search?q=...]
    B -->|Direct Browsing| E[All Products /shop]
    C --> F[Product Detail Page /product/slug]
    D --> F
    E --> F
    F -->|Enquire on WhatsApp| G[WhatsApp Conversation with Pre-filled Product Details]
    F -->|Select Options & Add to Cart| H[Cart Sidebar / Cart Page /cart]
    F -->|Click Buy Now| I[Direct Checkout /checkout]
    H -->|Apply Coupon & Check Pincode| H
    H -->|Proceed to Checkout| I
    I -->|Enter Address & Contact| J[Review & Payment Selection]
    J -->|UPI QR / VPA / Card / COD| K[Process Payment Transaction]
    K -->|Success| L[Order Confirmation Page /orders/confirmation]
    L -->|Instant Link| M[WhatsApp Order Confirmation]
    L -->|Download| N[Printable Tax Invoice]
```

---

## 2. Authentication & Account Flow

```mermaid
flowchart TD
    A[Visitor] --> B{Action}
    B -->|Click Account/Login| C[Login View]
    B -->|Click Register| D[Register View]
    B -->|Forgot Password| E[Password Reset Request]
    
    C -->|Valid Credentials| F{User Role}
    F -->|Customer| G[Customer Portal /account]
    F -->|Staff / Admin Roles| H[Admin Dashboard /admin]
    
    D -->|Submit Profile| I[Create User Record -> Assign 'customer' Role]
    I --> J[Migrate Guest Session Cart to DB Cart]
    J --> G
    
    G --> K[View Order History & Live Tracking]
    G --> L[Manage Saved Shipping Addresses]
    G --> M[View Wishlist]
    G --> N[Initiate Order Cancellation or Return]
```

---

## 3. Product Discovery, Filtering & Detail Flow

```mermaid
flowchart TD
    A[Catalog /shop] --> B[Filter Panel]
    B -->|Category Filter| C[Filter by Clay Pots, Planters, Kitchenware, etc.]
    B -->|Price Slider/Range| D[Under ₹999, ₹1000-₹1999, ₹2000+]
    B -->|Availability| E[In Stock Only]
    B -->|Sorting| F[Sort: Price Low-High, High-Low, Newest, Bestseller]
    
    C & D & E & F --> G[Filtered Product Grid]
    G --> H[Product Card]
    H -->|Click Card| I[Product Detail Page]
    H -->|Hover| J[Secondary Editorial Image Preview]
    H -->|Wishlist Icon| K[Toggle Wishlist Status]
    H -->|Quick Add| L[Instant Cart Addition with Notification]

    I --> M[Image Gallery with High-res Zoom]
    I --> N[Indian Pincode Delivery Estimator]
    I --> O[Stock Status: In Stock / Low Stock < 5 / Sold Out]
    I --> P[Product Specifications: Dimensions, Weight, Material, Care]
    I --> Q[Product WhatsApp Enquiry Pre-filled]
    I --> R[Customer Reviews & Star Ratings]
    I --> S[Related Products Showcase]
```

---

## 4. Cart & Inventory Verification Flow

```mermaid
flowchart TD
    A[Add to Cart Request] --> B{Item Exists in Cart?}
    B -->|Yes| C[Increment Quantity]
    B -->|No| D[Create Cart Item Record]
    
    C & D --> E[Validate Available Stock in Database]
    E -->|Stock >= Quantity| F[Update Cart Item & Recalculate Subtotal]
    E -->|Stock < Quantity| G[Display Error: Maximum Available Quantity Exceeded]
    
    F --> H{Apply Coupon Code?}
    H -->|Yes| I[Validate Code, Min Spend, Expiry & Usage Limit]
    I -->|Valid| J[Calculate Discount Amount]
    I -->|Invalid| K[Return Friendly Validation Message]
    
    J & K --> L[Calculate Shipping Fee: Free if Subtotal >= ₹1,999 else ₹149]
    L --> M[Calculate Final Grand Total]
    M --> N[Return Updated Cart View / JSON State]
```

---

## 5. Checkout & Payment Flow (UPI / Card / COD)

```mermaid
flowchart TD
    A[Checkout Initiation] --> B{Authenticated?}
    B -->|Yes| C[Prefill Saved Customer Addresses]
    B -->|No - Guest| D[Collect Contact Email, Phone & Delivery Address]
    
    C & D --> E[Serviceability Check via Indian Pincode]
    E -->|Unserviceable| F[Notify Customer & Request Alternative Address]
    E -->|Serviceable| G[Select Payment Method]
    
    G -->|UPI Option| H[Generate Interactive UPI QR Code & Show UPI VPA Input]
    G -->|Card / Netbanking| I[Payment Gateway Simulation Layer]
    G -->|Cash on Delivery| J[Validate COD Availability for Pincode]
    
    H & I & J --> K[Customer Submits 'Place Order']
    K --> L[Start Database Transaction]
    L --> M[Lock Product Records & Validate Stock]
    M -->|Stock Insufficient| N[Rollback Transaction & Alert User]
    M -->|Stock Verified| O[Decrement Inventory Quantities]
    O --> P[Create Order Record with Unique Order Number: OL-YYYYMMDD-XXXX]
    P --> Q[Create Order Items Snapshot]
    Q --> R[Record Payment Status & Transaction Details]
    R --> S[Clear Active Cart]
    S --> T[Commit Transaction]
    T --> U[Send Order Confirmation & Redirect to Success Page]
```

---

## 6. Order Fulfillment & Post-Purchase Lifecycle

```mermaid
flowchart TD
    A[Order Created: Status PENDING] --> B[Payment Verified: Status CONFIRMED]
    B --> C[Warehouse Packing: Status PROCESSING]
    C --> D[Courier Dispatched: Status SHIPPED]
    D -->|Admin Adds Tracking Number & Carrier Link| E[Customer Receives Tracking Update]
    E --> F[Delivery Complete: Status DELIVERED]
    
    B & C -->|Customer Requests Cancellation| G{Allow Cancellation?}
    G -->|Yes: Not Shipped| H[Status CANCELLED -> Restock Inventory -> Refund Initiated]
    
    F -->|Within 7 Days| I[Customer Requests Return / Exchange]
    I --> J[Admin Evaluates Return Request]
    J -->|Approved| K[Status RETURN_REQUESTED -> Pickup -> REFUNDED]
```

---

## 7. Role-Based Admin Operations Flow

```mermaid
flowchart TD
    A[Staff Member Logins at /admin/login] --> B{Verify Role}
    
    B -->|Super Admin| C[Full Unrestricted Access: Products, Orders, Users, Roles, Settings, Activity Logs, Backups]
    B -->|Content Manager| D[Homepage Banners, About Page, FAQs, Policy Text, Editorial Images]
    B -->|Product Manager| E[Create/Edit Products, SKU, Prices, Stock, Images, Categories]
    B -->|Order Manager| F[View Orders, Update Tracking, Process Status Changes, Download Invoices]
    B -->|Customer Support| G[View Customer Details, Inquiries, Reviews, WhatsApp Leads]
    B -->|Marketing Manager| H[Manage Coupons, View Sales Analytics, UTM Tracking, Pixel Config]
    B -->|Viewer| I[Read-only Views for Analytics and Catalogs]
```

---

## 8. Audit Trail & Price/Stock Change Logging

```mermaid
flowchart TD
    A[Staff Member Modifies Product / Price / Stock] --> B[Validate Request]
    B --> C[Fetch Original Values from Database]
    C --> D[Update Product Record]
    D --> E[Create ActivityLog Record]
    E -->|Capture| F[User ID, Role, Product Name, Old Price/Stock, New Price/Stock, Timestamp, IP]
    F --> G[Super Admin Activity Log Stream]
    
    note right of G
    Example Log Output:
    Product: Terracotta Water Pitcher
    Changed by: Product Manager (priya@oreon.com)
    Old price: ₹1,299
    New price: ₹1,099
    Date: 26 Aug 2026 16:30
    end
```
