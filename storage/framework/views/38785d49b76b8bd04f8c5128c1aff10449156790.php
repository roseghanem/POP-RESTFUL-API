Hello <?php echo e($user->name); ?>


You changed your email, so we need to verify this new address. Please use the link below:
<?php echo e(route('verify', $user->verification_token)); ?>

<?php /**PATH D:\Projects\Courses\Restful API\resources\views/emails/confirm.blade.php ENDPATH**/ ?>