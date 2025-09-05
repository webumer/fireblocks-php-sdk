# Contributing to Fireblocks PHP SDK

Thank you for your interest in contributing to the Fireblocks PHP SDK! This is an unofficial SDK created by the community.

## Getting Started

1. Fork the repository
2. Clone your fork: `git clone https://github.com/yourusername/fireblocks-php-sdk.git`
3. Install dependencies: `composer install`
4. Create a new branch: `git checkout -b feature/your-feature-name`

## Development

### Running Tests
```bash
composer test
```

### Code Style
```bash
composer cs-check
composer cs-fix
```

### Static Analysis
```bash
composer phpstan
```

## Pull Request Process

1. Ensure all tests pass
2. Follow PSR-12 coding standards
3. Add tests for new functionality
4. Update documentation as needed
5. Submit a pull request with a clear description

## Code Style

This project follows PSR-12 coding standards. Please ensure your code follows these guidelines.

## Testing

- Write unit tests for new features
- Ensure existing tests continue to pass
- Test both success and error scenarios

## Documentation

- Update README.md for new features
- Add PHPDoc comments for all public methods
- Include usage examples

## Issues

When reporting issues, please include:
- PHP version
- SDK version
- Steps to reproduce
- Expected vs actual behavior
- Error messages (if any)

## License

By contributing, you agree that your contributions will be licensed under the MIT License.
