# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.1] - 2025-01-06

### Fixed
- **JWT Token Signing**: Fixed JWT token signing to properly handle URI paths with leading slash
- **Authentication Issues**: Resolved "Token signed for incorrect url" errors in API requests
- **URL Path Normalization**: Improved path handling for proper Fireblocks API authentication

## [1.1.0] - 2025-01-06

### Added
- **Proper Vault Wallet Creation Flow**: Added `createVaultWallet()` method to VaultsService
- **Deposit Address Creation**: Added `createDepositAddress()` method to VaultsService
- **Two-Step Wallet Creation Process**: Following official Fireblocks documentation flow
- **Enhanced API Compliance**: Updated to match official Fireblocks API endpoints

### Changed
- **Wallet Creation Flow**: Now follows proper two-step process (create vault wallet → create deposit address)
- **API Endpoints**: Updated to use correct Fireblocks API endpoints
- **Error Handling**: Improved granular error handling for each step

### Fixed
- **API Compliance**: Fixed implementation to follow official Fireblocks documentation
- **Endpoint Usage**: Corrected API endpoint usage for vault wallet creation

## [1.0.0] - 2025-01-06

### Added
- Initial release
- Core SDK functionality
- Complete API coverage
- Comprehensive documentation
- Example usage
