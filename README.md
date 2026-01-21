
---

# 📕 README — Backend (Laravel)

```md
# Social Media Backend (Laravel)

Backend API สำหรับระบบ Social Media  
พัฒนาด้วย **Laravel**  
รองรับ Auth, Post, Comment, Like, Follow

---

## 🚀 Tech Stack
- Laravel
- PHP >= 8.1
- MySQL
- JWT / Sanctum
- REST API

---

## 📦 Requirements
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js (สำหรับ build asset ถ้ามี)

---

## 📥 Installation

### 1. Clone repository
```bash
git clone https://github.com/your-username/social-media-backend.git
cd social-media-backend



```
backend
├─ .cursor
│  ├─ mcp.json
│  └─ rules
│     └─ laravel-boost.mdc
├─ .editorconfig
├─ .prettierignore
├─ .prettierrc
├─ app
│  ├─ Actions
│  │  └─ Fortify
│  │     ├─ CreateNewUser.php
│  │     ├─ PasswordValidationRules.php
│  │     └─ ResetUserPassword.php
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ Admin
│  │  │  │  ├─ AdminController.php
│  │  │  │  └─ AuthController.php
│  │  │  ├─ Controller.php
│  │  │  └─ Settings
│  │  │     ├─ PasswordController.php
│  │  │     ├─ ProfileController.php
│  │  │     └─ TwoFactorAuthenticationController.php
│  │  ├─ Middleware
│  │  │  ├─ HandleAppearance.php
│  │  │  └─ HandleInertiaRequests.php
│  │  └─ Requests
│  │     ├─ AuthAdminRequest.php
│  │     └─ Settings
│  │        ├─ ProfileUpdateRequest.php
│  │        └─ TwoFactorAuthenticationRequest.php
│  ├─ Models
│  │  ├─ Admin.php
│  │  └─ User.php
│  └─ Providers
│     ├─ AppServiceProvider.php
│     └─ FortifyServiceProvider.php
├─ artisan
├─ boost.json
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ components.json
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ fortify.php
│  ├─ inertia.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ database.sqlite
│  ├─ factories
│  │  ├─ AdminFactory.php
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  ├─ 0001_01_01_000002_create_jobs_table.php
│  │  ├─ 2025_08_14_170933_add_two_factor_columns_to_users_table.php
│  │  ├─ 2026_01_03_045813_create_posts_table.php
│  │  ├─ 2026_01_03_045916_create_comments_table.php
│  │  ├─ 2026_01_03_045949_create_likes_table.php
│  │  ├─ 2026_01_03_050104_create_follows_table.php
│  │  └─ 2026_01_03_050224_create_admins_table.php
│  └─ seeders
│     └─ DatabaseSeeder.php
├─ eslint.config.js
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ public
│  ├─ .htaccess
│  ├─ apple-touch-icon.png
│  ├─ favicon.ico
│  ├─ favicon.svg
│  ├─ index.php
│  └─ robots.txt
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.ts
│  │  ├─ components
│  │  │  ├─ AlertError.vue
│  │  │  ├─ AppContent.vue
│  │  │  ├─ AppearanceTabs.vue
│  │  │  ├─ AppHeader.vue
│  │  │  ├─ AppLogo.vue
│  │  │  ├─ AppLogoIcon.vue
│  │  │  ├─ AppShell.vue
│  │  │  ├─ AppSidebar.vue
│  │  │  ├─ AppSidebarHeader.vue
│  │  │  ├─ Breadcrumbs.vue
│  │  │  ├─ DeleteUser.vue
│  │  │  ├─ Heading.vue
│  │  │  ├─ HeadingSmall.vue
│  │  │  ├─ Icon.vue
│  │  │  ├─ InputError.vue
│  │  │  ├─ NavFooter.vue
│  │  │  ├─ NavMain.vue
│  │  │  ├─ NavUser.vue
│  │  │  ├─ PlaceholderPattern.vue
│  │  │  ├─ TextLink.vue
│  │  │  ├─ TwoFactorRecoveryCodes.vue
│  │  │  ├─ TwoFactorSetupModal.vue
│  │  │  ├─ ui
│  │  │  │  ├─ alert
│  │  │  │  │  ├─ Alert.vue
│  │  │  │  │  ├─ AlertDescription.vue
│  │  │  │  │  ├─ AlertTitle.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ avatar
│  │  │  │  │  ├─ Avatar.vue
│  │  │  │  │  ├─ AvatarFallback.vue
│  │  │  │  │  ├─ AvatarImage.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ badge
│  │  │  │  │  ├─ Badge.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ breadcrumb
│  │  │  │  │  ├─ Breadcrumb.vue
│  │  │  │  │  ├─ BreadcrumbEllipsis.vue
│  │  │  │  │  ├─ BreadcrumbItem.vue
│  │  │  │  │  ├─ BreadcrumbLink.vue
│  │  │  │  │  ├─ BreadcrumbList.vue
│  │  │  │  │  ├─ BreadcrumbPage.vue
│  │  │  │  │  ├─ BreadcrumbSeparator.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ button
│  │  │  │  │  ├─ Button.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ card
│  │  │  │  │  ├─ Card.vue
│  │  │  │  │  ├─ CardAction.vue
│  │  │  │  │  ├─ CardContent.vue
│  │  │  │  │  ├─ CardDescription.vue
│  │  │  │  │  ├─ CardFooter.vue
│  │  │  │  │  ├─ CardHeader.vue
│  │  │  │  │  ├─ CardTitle.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ checkbox
│  │  │  │  │  ├─ Checkbox.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ collapsible
│  │  │  │  │  ├─ Collapsible.vue
│  │  │  │  │  ├─ CollapsibleContent.vue
│  │  │  │  │  ├─ CollapsibleTrigger.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ dialog
│  │  │  │  │  ├─ Dialog.vue
│  │  │  │  │  ├─ DialogClose.vue
│  │  │  │  │  ├─ DialogContent.vue
│  │  │  │  │  ├─ DialogDescription.vue
│  │  │  │  │  ├─ DialogFooter.vue
│  │  │  │  │  ├─ DialogHeader.vue
│  │  │  │  │  ├─ DialogOverlay.vue
│  │  │  │  │  ├─ DialogScrollContent.vue
│  │  │  │  │  ├─ DialogTitle.vue
│  │  │  │  │  ├─ DialogTrigger.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ dropdown-menu
│  │  │  │  │  ├─ DropdownMenu.vue
│  │  │  │  │  ├─ DropdownMenuCheckboxItem.vue
│  │  │  │  │  ├─ DropdownMenuContent.vue
│  │  │  │  │  ├─ DropdownMenuGroup.vue
│  │  │  │  │  ├─ DropdownMenuItem.vue
│  │  │  │  │  ├─ DropdownMenuLabel.vue
│  │  │  │  │  ├─ DropdownMenuRadioGroup.vue
│  │  │  │  │  ├─ DropdownMenuRadioItem.vue
│  │  │  │  │  ├─ DropdownMenuSeparator.vue
│  │  │  │  │  ├─ DropdownMenuShortcut.vue
│  │  │  │  │  ├─ DropdownMenuSub.vue
│  │  │  │  │  ├─ DropdownMenuSubContent.vue
│  │  │  │  │  ├─ DropdownMenuSubTrigger.vue
│  │  │  │  │  ├─ DropdownMenuTrigger.vue
│  │  │  │  │  └─ index.ts
│  │  │  │  ├─ input
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  └─ Input.vue
│  │  │  │  ├─ input-otp
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  ├─ InputOTP.vue
│  │  │  │  │  ├─ InputOTPGroup.vue
│  │  │  │  │  ├─ InputOTPSeparator.vue
│  │  │  │  │  └─ InputOTPSlot.vue
│  │  │  │  ├─ label
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  └─ Label.vue
│  │  │  │  ├─ navigation-menu
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  ├─ NavigationMenu.vue
│  │  │  │  │  ├─ NavigationMenuContent.vue
│  │  │  │  │  ├─ NavigationMenuIndicator.vue
│  │  │  │  │  ├─ NavigationMenuItem.vue
│  │  │  │  │  ├─ NavigationMenuLink.vue
│  │  │  │  │  ├─ NavigationMenuList.vue
│  │  │  │  │  ├─ NavigationMenuTrigger.vue
│  │  │  │  │  └─ NavigationMenuViewport.vue
│  │  │  │  ├─ separator
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  └─ Separator.vue
│  │  │  │  ├─ sheet
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  ├─ Sheet.vue
│  │  │  │  │  ├─ SheetClose.vue
│  │  │  │  │  ├─ SheetContent.vue
│  │  │  │  │  ├─ SheetDescription.vue
│  │  │  │  │  ├─ SheetFooter.vue
│  │  │  │  │  ├─ SheetHeader.vue
│  │  │  │  │  ├─ SheetOverlay.vue
│  │  │  │  │  ├─ SheetTitle.vue
│  │  │  │  │  └─ SheetTrigger.vue
│  │  │  │  ├─ sidebar
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  ├─ Sidebar.vue
│  │  │  │  │  ├─ SidebarContent.vue
│  │  │  │  │  ├─ SidebarFooter.vue
│  │  │  │  │  ├─ SidebarGroup.vue
│  │  │  │  │  ├─ SidebarGroupAction.vue
│  │  │  │  │  ├─ SidebarGroupContent.vue
│  │  │  │  │  ├─ SidebarGroupLabel.vue
│  │  │  │  │  ├─ SidebarHeader.vue
│  │  │  │  │  ├─ SidebarInput.vue
│  │  │  │  │  ├─ SidebarInset.vue
│  │  │  │  │  ├─ SidebarMenu.vue
│  │  │  │  │  ├─ SidebarMenuAction.vue
│  │  │  │  │  ├─ SidebarMenuBadge.vue
│  │  │  │  │  ├─ SidebarMenuButton.vue
│  │  │  │  │  ├─ SidebarMenuButtonChild.vue
│  │  │  │  │  ├─ SidebarMenuItem.vue
│  │  │  │  │  ├─ SidebarMenuSkeleton.vue
│  │  │  │  │  ├─ SidebarMenuSub.vue
│  │  │  │  │  ├─ SidebarMenuSubButton.vue
│  │  │  │  │  ├─ SidebarMenuSubItem.vue
│  │  │  │  │  ├─ SidebarProvider.vue
│  │  │  │  │  ├─ SidebarRail.vue
│  │  │  │  │  ├─ SidebarSeparator.vue
│  │  │  │  │  ├─ SidebarTrigger.vue
│  │  │  │  │  └─ utils.ts
│  │  │  │  ├─ skeleton
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  └─ Skeleton.vue
│  │  │  │  ├─ spinner
│  │  │  │  │  ├─ index.ts
│  │  │  │  │  └─ Spinner.vue
│  │  │  │  └─ tooltip
│  │  │  │     ├─ index.ts
│  │  │  │     ├─ Tooltip.vue
│  │  │  │     ├─ TooltipContent.vue
│  │  │  │     ├─ TooltipProvider.vue
│  │  │  │     └─ TooltipTrigger.vue
│  │  │  ├─ UserInfo.vue
│  │  │  └─ UserMenuContent.vue
│  │  ├─ composables
│  │  │  ├─ useAppearance.ts
│  │  │  ├─ useInitials.ts
│  │  │  └─ useTwoFactorAuth.ts
│  │  ├─ layouts
│  │  │  ├─ app
│  │  │  │  ├─ AppHeaderLayout.vue
│  │  │  │  └─ AppSidebarLayout.vue
│  │  │  ├─ AppLayout.vue
│  │  │  ├─ auth
│  │  │  │  ├─ AuthCardLayout.vue
│  │  │  │  ├─ AuthSimpleLayout.vue
│  │  │  │  └─ AuthSplitLayout.vue
│  │  │  ├─ AuthLayout.vue
│  │  │  └─ settings
│  │  │     └─ Layout.vue
│  │  ├─ lib
│  │  │  └─ utils.ts
│  │  ├─ pages
│  │  │  ├─ auth
│  │  │  │  ├─ ConfirmPassword.vue
│  │  │  │  ├─ ForgotPassword.vue
│  │  │  │  ├─ Login.vue
│  │  │  │  ├─ Register.vue
│  │  │  │  ├─ ResetPassword.vue
│  │  │  │  ├─ TwoFactorChallenge.vue
│  │  │  │  └─ VerifyEmail.vue
│  │  │  ├─ Dashboard.vue
│  │  │  ├─ settings
│  │  │  │  ├─ Appearance.vue
│  │  │  │  ├─ Password.vue
│  │  │  │  ├─ Profile.vue
│  │  │  │  └─ TwoFactor.vue
│  │  │  └─ Welcome.vue
│  │  ├─ ssr.ts
│  │  └─ types
│  │     ├─ globals.d.ts
│  │     └─ index.d.ts
│  └─ views
│     ├─ admin
│     │  ├─ dashboard.blade.php
│     │  └─ layouts
│     │     ├─ app.blade.php
│     │     ├─ header.blade.php
│     │     └─ sidebar.blade.php
│     └─ login.blade.php
├─ routes
│  ├─ console.php
│  ├─ settings.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  ├─ testing
│  │  └─ views
│  │     ├─ 034fdbb9b36d5ad12f35c28c044f8545.blade.php
│  │     ├─ 059ef607ca2158fc416c1cba3498a6f8.php
│  │     ├─ 0736e3c7da9be63a18df3e2a10e5a82f.php
│  │     ├─ 0852b904523df49f203622f85efa6c97.php
│  │     ├─ 0a2ac4bd5e907ef83234ec2bace1c959.php
│  │     ├─ 0ac93ea53860813a65856688c9be9d08.php
│  │     ├─ 0c3822a06da2679636fcd86869d72391.php
│  │     ├─ 11451d8e9df03e2feb4401855b406c3a.php
│  │     ├─ 12af6ed86dc311f65849c47aa5eeee4a.php
│  │     ├─ 170dd9f3c0fda6a1a4a31285830ad2e4.blade.php
│  │     ├─ 1a41fd35407062ff50978c7469050708.php
│  │     ├─ 1cbb26ad2414396f9c99c295e758c46b.php
│  │     ├─ 1cf58d267ab85f4378930ec416d2eb03.php
│  │     ├─ 1e823ddf975d13e70061a05e30e376ad.php
│  │     ├─ 22bc6256f47172ab46ee7b7a3ba44026.blade.php
│  │     ├─ 22d84110ecaafefc2b165947d3e800a7.php
│  │     ├─ 22e03df467a32c2776fa4ddad6b0f672.php
│  │     ├─ 27d8032ab50908377744dae211e25d4e.php
│  │     ├─ 2f2f69f942afbb010779298e9a2bd8d9.blade.php
│  │     ├─ 34e58651c40d8ed9789f4dc226670329.blade.php
│  │     ├─ 36eabc52e3f4424a09c3dd1145add20f.php
│  │     ├─ 39d0847a918c56cbb96b84154ba22a69.php
│  │     ├─ 3b4a6445f7b5c54d7c6a5300f4eb1d62.blade.php
│  │     ├─ 3ba24b41034ae6012f1d11fcdb6ca110.php
│  │     ├─ 3c0f1f59b215c6bb6db399565886ddf7.php
│  │     ├─ 3f5d98aa55d50aaed0c125503df05e13.php
│  │     ├─ 411650b99adb1cee4720d330fdeeaf85.php
│  │     ├─ 41fbc174bd500eafb37e2a89a3134559.php
│  │     ├─ 43c09f6c737826cf930cc047fa6f2c05.php
│  │     ├─ 4440c5cbdbafc71fc5c020aecb7ce9ad.php
│  │     ├─ 488c9441ef71590674663e272b4fde76.php
│  │     ├─ 49d46b546908408723271a98757a7ac1.blade.php
│  │     ├─ 4b87084478ac8942099ae722e9e53584.php
│  │     ├─ 4c6855db8f50373fe7219c54d05ef356.php
│  │     ├─ 5620cf92aa2b16021a991f23da5dac14.php
│  │     ├─ 571ccf7961a5e1a0234f33f4520cb052.blade.php
│  │     ├─ 57349234262c47dba0fcfa6f12005c45.php
│  │     ├─ 586ed4ceb764a4729f8f823cec06aa2b.blade.php
│  │     ├─ 609f2b8b93376bd707b71d600caf2b21.php
│  │     ├─ 666adf441a72e4f680c85b3b63ec103f.php
│  │     ├─ 69902b069a712d1e094c33fa25d4c169.blade.php
│  │     ├─ 6b4c026ad069b7bd01349444c4cfe21e.php
│  │     ├─ 75d87f6360cab1bcee42e9ebb03336bb.php
│  │     ├─ 79d64f76ba211d6d69c489596c456c3e.php
│  │     ├─ 7aafe12f973870f99689491ac63cb1cf.php
│  │     ├─ 7d961cf3a48c142be08da8c13c99adca.php
│  │     ├─ 803173a3c6757e5776bcb8fe87a3894b.php
│  │     ├─ 84d4b068814ffaf19a4a2f3153ca8ad3.blade.php
│  │     ├─ 87b24f7ef6635472d2ac5231aca1ed9c.php
│  │     ├─ 883726da292431fcd43a1b371eed6949.php
│  │     ├─ 89100818da56b5f0f806c94198e1955a.php
│  │     ├─ 8a1f21a024ae7581ebf60b7a071baf7a.php
│  │     ├─ 8be38d9cfde48ecff638eb35bac2c165.php
│  │     ├─ 8d074c552f506882005c70f0fa45d78f.php
│  │     ├─ 8de9fc10cd6974566466cb11866c5a2d.php
│  │     ├─ 8fa832c7c6ec34818be12ae5979d4a98.php
│  │     ├─ 990265a210a6d83bb72b00a8a14de4fb.blade.php
│  │     ├─ 9cb2e4000a74ff8969b33f54e8128b4e.php
│  │     ├─ 9e7bb4a6189e2908a9e4591bf513340c.php
│  │     ├─ a42557950e92212365d0a71e51c36be2.php
│  │     ├─ b5d90bc0d481a769845c41dda9fbbcca.blade.php
│  │     ├─ bc06ce7e9a3a4f477e93425038c3203d.php
│  │     ├─ c2eb8c7bfce5fde4cce11f3330d5e499.php
│  │     ├─ c868e626c52dda1bc02e3bff97a9d383.php
│  │     ├─ c9a0b349b34df3a69e17d19a6e8fa9e3.blade.php
│  │     ├─ cab418468d78adb71acd63617f8641a2.php
│  │     ├─ cdc0d28d485ad836a5223b96aad7803f.php
│  │     ├─ d34f1e8c5685a847bea23cea5e71f9d7.php
│  │     ├─ d394c13162546313e44fa1bc8a0ca421.blade.php
│  │     ├─ dabaaae3c259464eefcb213ba9d038b8.php
│  │     ├─ dfb024b950b5e621cd7e75049601325c.php
│  │     ├─ e403f779100fc326771e075c9659f952.php
│  │     ├─ e51632c70238a9f69d900c519dec43b1.php
│  │     ├─ ea57f5e831f8ff7292625887ddfd42cb.php
│  │     ├─ eb39a67d3122cbfa550e2c7accb92cde.php
│  │     ├─ ec48ba9b04aa6e9fdb32db1ce64ee6c8.php
│  │     ├─ eceb9f85fb198e40d86f4805f6bb6cf2.php
│  │     ├─ f0d513f6b721cf40759cede8716eeb20.php
│  │     ├─ f634c3a0e7f640258c5df1d2385ea22d.php
│  │     ├─ f716a24c346d267d9b26f69a4e1aadea.php
│  │     ├─ f9862777e6c30bbaf9a99e57f4c06d1f.blade.php
│  │     └─ ffdfa5446a38fdc3b59ff2ff4d412e4d.php
│  └─ logs
│     └─ laravel.log
├─ tests
│  ├─ Feature
│  │  ├─ Auth
│  │  │  ├─ AuthenticationTest.php
│  │  │  ├─ EmailVerificationTest.php
│  │  │  ├─ PasswordConfirmationTest.php
│  │  │  ├─ PasswordResetTest.php
│  │  │  ├─ RegistrationTest.php
│  │  │  ├─ TwoFactorChallengeTest.php
│  │  │  └─ VerificationNotificationTest.php
│  │  ├─ DashboardTest.php
│  │  ├─ ExampleTest.php
│  │  └─ Settings
│  │     ├─ PasswordUpdateTest.php
│  │     ├─ ProfileUpdateTest.php
│  │     └─ TwoFactorAuthenticationTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
├─ tsconfig.json
└─ vite.config.ts

```